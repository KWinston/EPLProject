<?php
include('Globals/GlobalFunctions.php');

class KitsController extends BaseController
{
    // ---------------------------------------------------------------------------------------------------
    // Show the kit managment page
    public function index()
    {
        return CheckIfAuthenticated('kit.kitManagment',
                                    ['selected_menu' => 'main-menu-administration',
                                     'selected_admin_menu' => 'admin-menu-manage-kits',
                                     'kitTypes' => KitTypes::all(),
                                     'branches' => Branches::all(),
                                     'kitStates' => KitState::all()
                                     ],
                                    'home.index',
                                    [],
                                    true);

    }

    // ---------------------------------------------------------------------------------------------------
    // Return the kit and the contents as a json encoded object
    public function show($kitID)
    {
        $kit = Kits::find($kitID);
        $data = $kit->toArray();

        $contents = array();
        $i = 0;
        foreach($kit->contents as $item)
        {
            $d = array();
            $d["ID"]            = $item->ID;
            $d["KitID"]         = $item->KitID;
            $d["Name"]          = $item->Name;
            $d["SerialNumber"]  = $item->SerialNumber;
            $d["MissingLogID"]  = $item->MissingLogID;
            if ($item->missingMessage != null)
                $d["MissingMessage"] = $item->missingMessage->LogMessage;
            else
                $d["MissingMessage"] = "";
            $d["DamagedLogID"]  = $item->DamagedLogID;
            if ($item->damagedMessage !=null)
                $d["DamagedMessage"] = $item->damagedMessage->LogMessage;
            else
                $d["DamagedMessage"] = "";

            $d["status"] = 0;// unmodified Record
            $contents[$i] = $d;
            $i += 1;
        }
        $data["contents"] = $contents;
        return json_encode($data);
    }

    // ---------------------------------------------------------------------------------------------------
    // Receive the json encoded kit and contents data in the input, and then pars it applying updates to
    // kit, and a CRUD update to the content records.
    public function store()
    {
        $inp = Input::all();

        // print dd($inp);

        $id = $inp['ID'];
        $kit = Kits::findOrFail($id);

        if (!isset($inp['Available']))
        {
            $inp['Available'] = 0;
        }
        $kit->fill($inp);
        $kit->save();
        $res = "OK";
        if (isset($inp["contents"]))
        {
            foreach($inp["contents"] as $idx => $item)
            {
                if ($item["status"] == 1) // CRUD, 1 == create
                {
                    $content = KitContents::create($item);
                    $content->save();
                }
                else if ($item["status"] == 3) // CRUD, 3 == update
                {
                    $content = KitContents::findOrFail($item["ID"]);
                    $content->fill($item);
                    if (isset($item["Damaged"]))
                    {
                        if ($item["Damaged"] == 0)
                        {
                            $content->DamagedLogID = null;
                        }
                        else if ($item["DamagedLogID"] == null)
                        {
                            $content->DamagedLogID = Logs::DamageReport($kit->KitType, $kit->ID, $content->ID, $item["DamagedMessage"]);
                        }
                    }
                    if (isset($item["Missing"]))
                    {
                        if ($item["Missing"] == 0)
                        {
                            $content->MissingLogID = null;
                        }
                        else if ($item["MissingLogID"] == null)
                        {
                            $content->MissingLogID = Logs::MissingReport($kit->KitType, $kit->ID, $content->ID, $item["missingMessage"]);
                        }

                    }
                    $content->save();
                }

                if ($item["status"] == 4 && $item["ID"] != "***NEW***")
                {
                    // delete the kitContent
                    $content = KitContents::destroy($item["ID"]);
                }
            }
        }
        return $res;
    }

    // ---------------------------------------------------------------------------------------------------
    // Destroy the the kit and all it's contents.
    public function destroy($kitID)
    {
        $kit = Kits::find($kitID);
        foreach($kit->contents as $content)
            KitContents::destroy($content->ID);
        Kits::destroy($kitID);
    }

    public function kitDetails($kitID)
    {
        $kit = Kits::findOrFail($kitID);
        $bookingIDs = DB::select( "(SELECT ID
                                    FROM Booking AS B
                                   WHERE B.KitID = ?
                                         AND B.EndDate < now()
                                   LIMIT 3
                                 )
                                 UNION
                                 (
                                  SELECT ID
                                    FROM Booking AS B
                                   WHERE B.KitID = ?
                                         AND B.EndDate >= now()
                                   LIMIT 3
                                )
                               ", array($kitID, $kitID));

        $ids = array();
        foreach($bookingIDs as $id)
        {
            array_unshift($ids, $id->ID);
        }
        $bookings = Booking::whereIn("ID", $ids)->get();
        // print dd($bookings->toarray());
        $logs = DB::select( "SELECT L.LogType, L.LogDate, KC.Name, KC. SerialNumber, L.LogMessage
                               FROM Logs AS L
                                 INNER JOIN Kits as K ON (K.ID = L.LogKey2)
                                   INNER JOIN KitContents as KC ON (KC.KitID = L.LogKey2 AND KC.ID = L.LogKey3)
                              WHERE K.ID = ?
                                    AND L.LogType in (1,2)
                              ORDER BY LogDate DESC
                            ", array($kitID));

        return View::make("kit.kitDetails", ['kit' => $kit, 'bookings' => $bookings, 'logs' => $logs]);
    }
    // ---------------------------------------------------------------------------------------------------
    // Create a new kit.
    public function create()
    {
        $kit = Kits::create(array(
            'KitType' => 0,
            'AtBranch' => 0,
            'KitState' => 1,
            'Available' =>0 ,
            'Name' => "New Kit Name",
            'KitDesc' => "Place a description of the contents of this kit here. "
            ));

        $res = $this->makeJTreeKitRecord($kit);
        return $res;
    }


    // ---------------------------------------------------------------------------------------------------
    // Create a record sutible for adding to Jstree.
    protected function makeJTreeKitRecord($kit)
    {
        $key = 'type_' . $kit->KitType;
        $n = $kit->Name;
        if (((int)$kit->Specialized) == 1)
        {
            $n = $n . ' + ' . $kit->SecializedName;
        }

        $res = array(
                      'type' => 'KIT',
                      'id' => 'kit_' . $kit->ID,
                      'KitID' => $kit->ID,
                      'KitTypeID' => $kit->type->ID,
                      'text' => $n,
                      'parent' => "#",
                      'state' => array( 'opened' => false, 'disabled' => false, 'selected' => false),
                      'children' => array()
                    );
        return json_encode($res);
    }

}

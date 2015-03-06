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
            $d["Damaged"]       = $item->Damaged;
            $d["Missing"]       = $item->Missing;

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
                    $content->save();
                }

                if ($item["status"] == 4 && $item["ID"] != "***NEW***")
                {
                    // delete the kitContent
                    $content = KitContents::destroy($item["ID"]);
                }
            }
        }
        return "OK";
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

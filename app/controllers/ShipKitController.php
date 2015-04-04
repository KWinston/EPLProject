<?php
include('Globals/GlobalFunctions.php');

class ShipKitController extends BaseController {

	public function index()
	{
        $branch = Branches::find(Session::get('branch'));
        if (!isset($branch))
        {
            $branch = Branches::find(0);
        }
        $data = DB::select('SELECT
                              K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.BarcodeNumber, K.Specialized,  K.SpecializedName,
                              B.ID as BookingID, B.ForBranch, B.StartDate, B.EndDate, B.ShadowStartDate, B.ShadowEndDate, B.Purpose,
                              KS.StateName,
                              KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc
                              FROM Booking AS B
                                INNER JOIN Kits as K ON (K.ID = B.KitID)
                                  INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                  INNER JOIN KitSTate AS KS ON (KS.ID = K.KitState)
                             WHERE now() BETWEEN DATE_ADD(B.ShadowStartDate, INTERVAL -1 DAY) AND B.ShadowEndDate
                                   AND K.AtBranch = ?
                                   AND B.ForBranch <> K.AtBranch
                                   ORDER BY BookingID
                                   ',
                                   array($branch->ID));

        return CheckIfAuthenticated('members.sendKit',[ 'branch_name' => $branch->Name, 'selected_menu' => 'main-menu-ship', 'shipKits' => $data], 'home.index', [], false);
    }

    public function store()
    {
        $kit = Kits::findOrFail(Input::get('ID'));
        $kit->KitState = 2;
        $kit->save();
        foreach ($kit->contents as $content)
        {
            if (Input::has('isMissing_'.$content->ID) &&
                Input::get('isMissing_'.$content->ID) == '1' &&
                $content->MissingLogID == null) 
            {
                $message = Input::get('MissingID_'.$content->ID);
                $logID = Logs::MissingReport($kit->KitType, $kit->ID, $content->ID, $message);
                $content->MissingLogID = $logID;
            }

            if (Input::has('isDamaged_'.$content->ID) &&
                Input::get('isDamaged_'.$content->ID) == '1' &&
                $content->DamagedLogID == null) 
            {
                $message = Input::get('DamagedID_'.$content->ID);
                $logID = Logs::DamageReport($kit->KitType, $kit->ID, $content->ID, $message);
                $content->DamagedLogID = $logID;
            }
            $content->save();
        }
        if (Input::has('LogMessage') &&
           strlen(Input::get('LogMessage')) > 0)
        {
            $message = Input::get('LogMessage');
            $logNote = Logs::Note($kit->KitType, $kit->ID, NULL, $message);
        }
        return Redirect::action('recieve_kit.index');
    }

    // Show the Edit form
    public function edit($BookingID)
    {
        $booking = Booking::findOrFail($BookingID);
        return View::make("members.receiveKitEdit", ['booking' => $booking, 'mode' => 'ship']);
    }

       public function findKit($bookingID)
    {
        $branch = Branches::find(Session::get('branch'));
        // If the session is not set, default to the IT depot
        if (!isset($branch))
        {
            $branch = Branches::find(0);
        }
        // Get Kits to be received
        $data = DB::select('SELECT
                              K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.BarcodeNumber, K.Specialized,  K.SpecializedName,
                              B.ID as BookingID, B.ForBranch, B.StartDate, B.EndDate, B.ShadowStartDate, B.ShadowEndDate, B.Purpose,
                              KS.StateName,
                              KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc
                              FROM Booking AS B
                                INNER JOIN Kits as K ON (K.ID = B.KitID)
                                  INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                  INNER JOIN KitSTate AS KS ON (KS.ID = K.KitState)
                             WHERE now() BETWEEN DATE_ADD(B.ShadowStartDate, INTERVAL -1 DAY) AND B.ShadowEndDate
                                   AND B.ForBranch = ?
                                   AND B.ForBranch <> K.AtBranch
                                   ORDER BY BookingID
                                   ',
                                   array( $branch->ID));

        // Get Kits to be sent out
        $data2 = DB::select('SELECT
                              K.ID AS KitID, K.KitType, K.Name AS KitName, K.AtBranch, K.KitState, K.BarcodeNumber, K.Specialized,  K.SpecializedName,
                              B.ID as BookingID, B.ForBranch, B.StartDate, B.EndDate, B.ShadowStartDate, B.ShadowEndDate, B.Purpose,
                              KS.StateName,
                              KT.Name AS KitTypeName, KT.TypeDescription as KitTypeDesc
                              FROM Booking AS B
                                INNER JOIN Kits as K ON (K.ID = B.KitID)
                                  INNER JOIN KitTypes AS KT ON (KT.ID = K.KitType)
                                  INNER JOIN KitSTate AS KS ON (KS.ID = K.KitState)
                             WHERE now() BETWEEN DATE_ADD(B.ShadowStartDate, INTERVAL -1 DAY) AND B.ShadowEndDate
                                   AND K.AtBranch = ?
                                   AND B.ForBranch <> K.AtBranch
                                   ORDER BY BookingID
                                   ',
                                   array($branch->ID));

        $findBookID = Booking::findOrFail($bookingID);
        $theBookID = $findBookID->ID;

        return CheckIfAuthenticated('members.receiveKitManagement',[ 'mode' => 'send',
                                                                     'branch' => $branch,
                                                                     'selected_menu' => 'main-menu-receive',
                                                                     'receiveKits' => $data,
                                                                     'sendKits' => $data2,
                                                                     'findBookID' => $theBookID,
                                                                     'kitTypes' => KitTypes::all()
                                                                    ],
                                                                     'home.index', [], false);
  }
}
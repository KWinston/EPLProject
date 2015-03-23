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
        //print dd(Input::All());

        $kit = Kits::findOrFail(Input::get('ID'));
        $kit->state = 2;
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
            $logNote = Logs::Note($kit->KitType, $kit->ID, $message);
        }
        return "OK";
    }

    public function findKit($theKitID)
    {
        $index = Session::All();
        $post = Input::except('ID');
        $branch = Branches::find(Session::get('branch'));

        $shipKits = DB::table('Booking')
            ->join('BookingDetails',
                'Booking.ID', '=', 'BookingDetails.BookingID')
            ->join('Kits',
                'Booking.KitID', '=', 'Kits.ID')
            ->join('KitState',
                'KitState.ID', '=', 'Kits.KitState')
            ->join('KitTypes',
                'KitTypes.ID', '=', 'Kits.KitType')
            ->join('Branches', function($join)
            {
                $join->on('Kits.AtBranch', '=', 'Branches.ID');
            })
                        
            ->where('Booking.ForBranch', $index['branch'])
            ->where('Booking.KitID', $theKitID)
            ->select('Booking.*', 'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc', 'KitState.StateName', 'KitTypes.Name', 'Branches.Name As BName')
            ->orderBy('Booking.StartDate')
            ->get();

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($shipKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($shipKits), $perPage);

        return CheckIfAuthenticated('members.shipkit',[ 'branch_name' => $branch->Name, 'selected_menu' => 'main-menu-ship', 'shipKits' => $data], 'home.index', [], false);
    }

    public function shipOut()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('ID');
        $index = Input::get('ID');

        $stat = DB::table('Booking')
            ->where('id', $index)
            ->update(array(
                'KitID' => $post['KitID'],
                'AtBranch' => $post['AtBranch'],
                'KitStatus' => $post['KitStatus'],
            ));

        return Response::json(array(
            'success' => $stat = 1 ? true : false
        ), 200);
    }
}
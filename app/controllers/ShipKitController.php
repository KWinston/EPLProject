<?php
include('Globals/GlobalFunctions.php');

class ShipKitController extends BaseController {

	public function index()
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
            ->select('Booking.*', 'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc', 'KitState.StateName', 'KitTypes.Name', 'Branches.Name As BName')
            ->orderBy('Booking.StartDate')
            ->orderBy('Booking.ID')
            ->get();

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($shipKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($shipKits), $perPage);
		
        return CheckIfAuthenticated('members.shipkit',[ 'branch_name' => $branch->Name, 'selected_menu' => 'main-menu-ship', 'shipKits' => $data], 'home.index', [], false);
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
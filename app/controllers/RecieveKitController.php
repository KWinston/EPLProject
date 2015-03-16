<?php
include('Globals/GlobalFunctions.php');

class RecieveKitController extends BaseController {

	public function index()
	{
        $index = Session::All();
        $post = Input::except('ID');
        $branch = Branches::find(Session::get('branch'));

        $receiveKits = DB::table('Booking')
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
            ->select('Booking.*', 'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc',
                'KitState.StateName', 'KitTypes.Name', 'Branches.Name As BName')
            ->orderBy('Booking.StartDate')
            ->orderBy('BookingID')
            ->get();

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);
        
		return CheckIfAuthenticated('members.receivekit',[ 'branch_name' => $branch->Name,
                'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
	}

    public function findKit($bookingID)
    {
        $index = Session::All();
        $post = Input::except('ID');
        $branch = Branches::find(Session::get('branch'));

        $receiveKits = DB::table('Booking')
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
            ->where('Booking.ID', $bookingID)
            ->select('Booking.ID As BookingID', 'Booking.StartDate', 'Booking.EndDate', 'Booking.KitID As KitID',
                'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc', 'KitState.StateName',
                'KitTypes.Name', 'Branches.Name As BName', 'Branches.ID As BranchesID')
            ->get();

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);

        return CheckIfAuthenticated('members.receivekit',[ 'branch_name' => $branch->Name,
                'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
    }

    public function confirmReceive()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('ID');
        $index = Input::get('ID');

        $stat = DB::table('Kits')
            ->where('id', $post['KitID'])
            ->update(array(
                'AtBranch' => $post['ForBranch'],
                'KitState' => '1',
            ));

        return Response::json(array(
            'success' => $stat = 1 ? true : false
        ), 200);
    }
}
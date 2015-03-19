<?php
include('Globals/GlobalFunctions.php');

class RecieveKitController extends BaseController {

	public function index()
	{
        $branch = Branches::find(Session::get('branch'));

        $receiveKits = DB::table('Booking')
            ->join('BookingDetails',
                'Booking.ID', '=', 'BookingDetails.BookingID')
            ->join('Kits', function($join)
            {
                $join->on('Booking.KitID', '=', 'Kits.ID');
            })
            ->join('KitState',
                'KitState.ID', '=', 'Kits.KitState')
            ->join('KitTypes',
                'KitTypes.ID', '=', 'Kits.KitType')
            ->join('Branches', function($join)
            {
                $join->on('Kits.AtBranch', '=', 'Branches.ID');
            })
                        
            ->where('Booking.ForBranch', $branch->ID)
            ->select('Booking.*', 'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc',
                'KitState.StateName', 'KitTypes.Name', 'Branches.Name As BName')
            ->orderBy('Booking.StartDate')
            ->orderBy('BookingID')
            ->get();
/* Need history of AtBranch stored in bookings? then populate last 3 non-null? or just use last 3 ForBranch
        $prevbranch = DB::table('Booking')
            ->join('BookingDetails',
                'Booking.ID', '=', 'BookingDetails.BookingID')
            ->join('Kits',
                    'Booking.KitID', '=', 'Kits.ID')
            ->join('Branches', function($join)
            {
                $join->on('Kits.AtBranch', '=', 'Branches.ID');
            })
            ->select('Booking.ID', 'Booking.KitID', 'Kits.AtBranch', 'Booking.StartDate',)
            ->orderBy('Booking.KitID', 'asc')
            ->orderBy('Booking.StartDate', 'desc')
            ->get();
            */

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);

		return CheckIfAuthenticated('members.receivekit',[ 'branch' => $branch,
                'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
	}

    public function findKit($bookingID)
    {
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
                        
            ->where('Booking.ForBranch', $branch->ID)
            ->where('Booking.ID', $bookingID)
            ->select('Booking.ID As BookingID', 'Booking.StartDate', 'Booking.EndDate', 'Booking.KitID As KitID',
                'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc', 'KitState.StateName',
                'KitTypes.Name', 'Branches.Name As BName', 'Branches.ID As BranchesID')
            ->get();

        $perPage = 5;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);

        return CheckIfAuthenticated('members.receivekit',[ 'branch' => $branch,
                'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
    }

    public function confirmReceive()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('ID');

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
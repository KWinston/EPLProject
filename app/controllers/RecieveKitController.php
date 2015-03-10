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
                $join->on('Kits.AtBranch', '=', 'Branches.BranchID');
                     //->where('Booking.KitID', '=', 'Kits.ID');
            })

            ->where('Booking.ForBranch', $index['branch'], 0)
            ->select('Booking.*', 'BookingDetails.*', 'Kits.AtBranch', 'Kits.KitState', 'Kits.KitDesc', 'KitState.StateName', 'KitTypes.Name')
            ->get();

        $perPage = 3;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);
        //return $receiveKits;
		return CheckIfAuthenticated('members.receivekit',[ 'branch_name' => $branch->Name, 'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
	}

    /* public function getKitInfo()
    {
        $index = Input::get('ID');

        return DB::table('Booking')
            ->join('BookingDetails',
                'Booking.id', '=', 'BookingDetails.BookingID')
            ->where('Booking.KitID', $index)
            ->get();
    }
    */
}
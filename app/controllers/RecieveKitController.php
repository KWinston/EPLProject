<?php
include('Globals/GlobalFunctions.php');

class RecieveKitController extends BaseController {

	public function index()
	{
        $index = Session::All();

        $receiveKits = DB::table('Booking')
            ->join('BookingDetails',
                'Booking.ID', '=', 'BookingDetails.BookingID')
            ->where('Booking.ForBranch', $index['branch'], 0)
            ->get();

        $perPage = 3;
        $currentPage = Input::get('page', 1) - 1;
        $pagedData = array_slice($receiveKits, $currentPage * $perPage, $perPage);
        $data = Paginator::make($pagedData, count($receiveKits), $perPage);

		return CheckIfAuthenticated('members.receivekit',[ 'selected_menu' => 'main-menu-receive', 'receiveKits' => $data], 'home.index', [], false);
	}
}
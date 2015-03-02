<?php
include('Globals/GlobalFunctions.php');

class BookKitController extends BaseController {

    public function index()
    {
        return CheckIfAuthenticated('members.bookkit',[
            'selected_menu' => 'main-menu-book'
            ], 'home.index', [], false);
    }

    public function updateBooking()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('ID');
        $index = Input::get('ID');

        $branchID = Branches::select('ID')
            ->where('BranchID', '=', $post['ForBranch'])
            ->first();

        $post['KitID'] = intval($post['KitID']);
        $post['ForBranch'] = intval($branchID['ID']);

        $stat = DB::table('Booking')
            ->where('id', $index)
            ->update(array(
                'ShadowStartDate' => $post['ShadowStartDate'],
                'ShadowEndDate' => $post['ShadowEndDate'],
                'StartDate' => $post['StartDate'],
                'EndDate' => $post['EndDate']
            ));

        return Response::json(array(
            'success' => $stat = 1 ? true : false
        ), 200);
    }

    public function insertBooking()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::all();

        $post['KitID'] = intval($post['KitID']);

        $booking = new Booking;
        $booking->fill($post);
        $booking->save();

        $bookingDetail = new BookingDetails;
        $bookingDetail->fill(array(
            'BookingID' => $booking->ID,
            'UserID' => Auth::user()->id,
            'Email' =>  Auth::user()->Email,
            'Booker' => 1
        ));
        $bookingDetail->save();

        return Response::json(array(
            'success' => true,
            'insert_id' => $booking->ID
        ), 200);
    }

    public function getKitBookings()
    {
        if(!Request::ajax())
            return "not a json request";

        $index = Input::get('ID');

        return DB::table('Booking')
            ->join('BookingDetails',
                'Booking.id', '=', 'BookingDetails.BookingID')
            ->where('Booking.KitID', $index)
            ->get();
    }

    public function getTypeOverlaps()
    {
        if(!Request::ajax())
            return "not a json request";

        $kitType = Input::get('Type');

        $kits = Kits::where('kitType', '=', $kitType)->get();
        return $kits;
        foreach ($kits as $value)
        {}
    }

    public function getShadowDays()
    {
    	if(!Request::ajax())
            return "not a json request";

        $data = Input::all();

        if($data['ID'] == "*")
            $branch = 'ALL';    // get all information
        else
        {
            $branch = Branches::select('BranchID')
                ->where('ID', '=', $data['ID'])
                ->pluck('BranchID');
            $branch =  str_replace(['EPL'], [''], $branch);
        }

        $url = str_replace([':FORMAT', ':BRANCH'], ['xml', $branch], API_URL());

        return xmlToJSON($url);
    }
}

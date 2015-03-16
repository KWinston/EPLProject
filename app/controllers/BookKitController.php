<?php
include('Globals/GlobalFunctions.php');

class BookKitController extends BaseController {

    public function index()
    {
        $selected_id = Input::get("selected_id");
        if (!isset($selected_id))
        {
            $selected_id = null;
        }
        return CheckIfAuthenticated('members.bookkit',[
            'selected_menu' => 'main-menu-book',
            'selected_id' => $selected_id
            ], 'home.index', [], false);
    }

    public function updateBooking()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('ID');
        $index = Input::get('ID');

        $stat = DB::table('Booking')
            ->where('id', $index)
            ->update(array(
                'ShadowStartDate' => $post['ShadowStartDate'],
                'ShadowEndDate' => $post['ShadowEndDate'],
                'StartDate' => $post['StartDate'],
                'EndDate' => $post['EndDate']
            ));

        // Logs::BookingRequestEdited($post['BookingID'], $post['KitID'], $post['StartDate'], $post['EndDate']);

        return Response::json(array(
            'success' => true
        ), 200);
    }

    public function insertBooking()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::except('Notifees');
        $notifees = Input::get('Notifees');

        $booking = new Booking;
        $booking->fill($post);
        $booking->save();

        $bookingDetail = new BookingDetails;
        $bookingDetail->fill(array(
            'BookingID' => $booking->ID,
            'UserID' => Auth::user()->id,
            'Email' =>  Auth::user()->email,
            'Booker' => 1
        ))->save();

        if (count($notifees) > 0)
        {
            foreach ($notifees as $notifee)
            {
                $temp = User::where('email', $notifee)->first();
                $bookingDetail = new BookingDetails;
                $bookingDetail->fill(array(
                    'BookingID' => $booking->ID,
                    'UserID' => $temp->id,
                    'Email' =>  $temp->email,
                    'Booker' => 0
                ));
                $bookingDetail->save();
            }
        }

        /*
        Logs::BookingRequestCreated(
            $booking->ID,
            $post['KitID'],
            $post['ForBranch'],
            $post['StartDate'],
            $post['EndDate']
        );
        */

        return Response::json(array(
            'success' => true,
            'insert_id' => $booking->ID
        ), 200);
    }

    public function deleteBooking()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::all();

        BookingDetails::where('BookingID', '=', $post['BookID'])
            ->delete();
            
        Booking::destroy($post['BookID']);

        return Response::json(array(
            'success' => true
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
            ->where('BookingDetails.Booker', 1)
            ->get();
    }

    public function getTypeBookings()
    {
        if(!Request::ajax())
            return "not a json request";

        $kitTypeID = Input::get('Type');

        return DB::table('Booking')
            ->join('Kits',
                'Booking.KitID', '=', 'Kits.ID')
            ->join('KitTypes',
                'Kits.KitType', '=', 'KitTypes.ID')
            ->where('Kits.KitType', $kitTypeID)
            ->orderBy('Booking.KitID', 'asc')
            ->orderBy('Booking.StartDate', 'asc')
            ->get();
    }

    public function getAvailableKit()
    {
        if(!Request::ajax())
            return "not a json request";

        $post = Input::all();

        $kitsOfType = Kits::where('Available', '1')
            ->where('KitType', $post['KitTypeID'])
            ->orderBy('Specialized', 'asc')
            ->get();

        foreach($kitsOfType as $kit)
        {
            $bookings = Booking::where('KitID', $kit->ID)
                ->where(function($query) use ($post) 
                {
                    $range = array($post['StartDate'], $post['EndDate']);
                    $query->whereBetween('StartDate', $range)
                        ->orWhereBetween('EndDate', $range);
                })
                ->count();
            
            if ($bookings == 0)
            {
                return $kit;
            }
        }
        return "";
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

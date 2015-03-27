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
        $notifees = Input::get('Notifees');

        $stat = DB::table('Booking')
            ->where('id', $index)
            ->update(array(
                'ShadowStartDate' => $post['ShadowStartDate'],
                'ShadowEndDate' => $post['ShadowEndDate'],
                'StartDate' => $post['StartDate'],
                'EndDate' => $post['EndDate'],
                'ForBranch' => $post['ForBranch']
            ));

        BookingDetails::where('BookingID', $index)
            ->where('Booker', 0)
            ->delete();

        if (count($notifees) > 0)
        {
            foreach ($notifees as $notifee)
            {
                $temp = User::where('email', $notifee['Email'])->first();
                if ($temp != null)
                {
                    $bookingDetail = new BookingDetails;
                    $bookingDetail->fill(array(
                        'BookingID' => $index,
                        'UserID' => $temp->id,
                        'Email' =>  $temp->email,
                        'Booker' => 0
                    ));
                    $bookingDetail->save();
                }
                else
                {
                    $bookingDetail = new BookingDetails;
                    $bookingDetail->fill(array(
                        'BookingID' => $index,
                        'Email' =>  $notifee['Email'],
                        'Booker' => 0
                    ));
                    $bookingDetail->save();
                }
            }
        }

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
                $temp = User::where('email', $notifee['Email'])->first();
                if ($temp != null)
                {
                    $bookingDetail = new BookingDetails;
                    $bookingDetail->fill(array(
                        'BookingID' => $booking->ID,
                        'UserID' => $temp->id,
                        'Email' =>  $temp->email,
                        'Booker' => 0
                    ));
                    $bookingDetail->save();
                }
                else
                {
                    $bookingDetail = new BookingDetails;
                    $bookingDetail->fill(array(
                        'BookingID' => $booking->ID,
                        'Email' =>  $notifee['Email'],
                        'Booker' => 0
                    ));
                    $bookingDetail->save();
                }
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

        $bookings = Booking::where('KitID', $index)->get();

        foreach ($bookings as $booking)
        {
            $user = BookingDetails::select('UserID')
                ->where('BookingID', $booking->ID)
                ->where('Booker', 1)
                ->first();

            $booking['UserID'] = $user->UserID;

            $booking['KitRecipients'] = BookingDetails::where('BookingID', $booking->ID)
                ->where('Booker', 0)
                ->get();
        }  
        return $bookings;
    }

    public function getTypeBookings()
    {
        if(!Request::ajax())
            return "not a json request";

        $query = 
            "select K.ID as KitID,". 
            "   KT.Name as Name,". 
            "   B.ShadowStartDate as ShadowStartDate,".
            "   B.ShadowEndDate as ShadowEndDate ".
            "from Booking as B".
            "   right join Kits as K".
            "      on B.KitID = K.ID".
            "   inner join KitTypes as KT".
            "      on K.KitType = KT.ID ".
            "where K.KitType = '".Input::get('Type')."' ".
            "order by K.ID asc,".
            "   B.StartDate asc";

        return DB::select(DB::raw($query));
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
            $query = 
                "select B.ID ".
                "from Booking as B ".
                "inner join Kits as K ".
                    "on B.KitID = K.ID ".
                "where B.KitID = ".$kit->ID." ".
                "and (".    
                    "('".$post['StartDate']."' between CAST(B.StartDate as Date) and CAST(B.EndDate as Date)) ".
                    "or ('".$post['EndDate']."' between CAST(B.StartDate as Date) and CAST(B.EndDate as Date))".
                ")";

            $bookings = DB::select(DB::raw($query));
            
            if (intval(count($bookings)) == 0)
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

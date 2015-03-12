<?php

class HomeController extends BaseController
{
    public function index()
    {
        $branch = Branches::find(Session::get('branch'));

        // If the session is not set, default to the IT depot
        if (!isset($branch))
        {
            $branch = Branches::find(0);
        }
        //get today's date and format to shadow dates
        date_default_timezone_set('UTC');
        //$today = date("y-m-d 00:00:00");

        //test arrivals
        $today = "2015-03-21 00:00:00";

        //test departures
        //$today = "2015-03-11 00:00:00";

        $bookings = Booking::get(); 
        $arrivals = array();
        $departures = array();
        //return $bookings;
        foreach ($bookings as $booking) {
            //display notice for arrive inbetween Start of Shadow and Start Date
            if (strtotime($booking->ShadowStartDate) < time() && time () < strtotime($booking->StartDate))
            {
                //check if booking is related to branch on display
                if(Session::get('branch') == $booking->ForBranch)
                {
                    array_push($arrivals, $booking);
                }
            }
            //2 day notice for departures
            if (strtotime('-2 day', strtotime($booking->ShadowStartDate)) < time() && time() < strtotime($booking->ShadowStartDate))
            {
                    //require check for related departure branch 
                    array_push($departures, $booking);
            }

        }


        return View::make('home', array(
            'kits' => $branch->kits,
            'branch_name' => $branch->Name, 
            'today' => $today,
            'arrivals' => $arrivals,
            'departures' => $departures,
            'selected_menu' => 'main-menu-home'
        ));
    }
}

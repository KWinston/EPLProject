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
        //$today = "2015-03-21 00:00:00";

        //test departures
        $today = "2015-03-11 00:00:00";

        $bookings = Booking::get(); 
        $arrivals = array();
        $departures = array();
        foreach ($bookings as $booking) {
            if ($booking->ShadowEndDate == $today){
                array_push($arrivals, Kits::find($booking->KitID));
            }
            if ($booking->ShadowStartDate == $today){
                array_push($departures, Kits::find($booking->KitID));
            }
        }
        //return $bookings;   

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

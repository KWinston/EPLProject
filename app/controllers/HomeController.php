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
        //get today's date
        date_default_timezone_set('UTC');
        $today = date("y-m-d 00:00:00");

        $arrive_today = Booking::get();

        return View::make('home', array(
            'kits' => $branch->kits,
            'branch_name' => $branch->Name, 
            'arrive_today' => $arrive_today,
            'selected_menu' => 'main-menu-home'
        ));
    }
}

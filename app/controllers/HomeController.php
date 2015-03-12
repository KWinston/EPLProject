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
        // Need to filter for shadow range
        $arriveing = Booking::where('ForBranch', '=', $branch->ID)
            ->join('kits','kits.ID', '=', 'booking.KitID')
            ->select('kits.ID as KitsID', "booking.ID as bookingID", "booking.*", "kits.ID")
            ->get();
        // print dd($arriveing->toarray()[0]);

        $departing = Booking::where('booking.ShadowStartDate', '<=', '2015-03-10 00:00:00')
            ->where('booking.StartDate', '<=', '2015-03-13 00:00:00')
            ->join('kits','kits.ID', '=', 'booking.KitID')
            ->where('kits.AtBranch', '<>', $branch->ID)
            ->where('kits.KitState', '=', '1')
            ->select('kits.ID as KitsID', "booking.ID as bookingID", "booking.*", "kits.ID")
            ->get();
        $kitIDs = array();
        foreach( $arriveing as $kit)
        {
            array_unshift($kitIDs, $kit->ID);
        }
        foreach ( $departing as $kit)
        {
            array_unshift($kitIDs, $kit->ID);
        }


        $kitData = Kits::where('AtBranch', '=', $branch->ID)
            ->where('KitState', '=', '1')
            ->whereNotIn('ID', $kitIDs)
            ->get();
        //get today's date
        return View::make('home', array(
            'kits' => $kitData,
            'branch_name' => $branch->Name,
            'arrive_today' => $arriveing,
            'depart_today' => $departing,
            'selected_menu' => 'main-menu-home'
        ));
    }
}

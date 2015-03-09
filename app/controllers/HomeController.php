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

        return View::make('home', array(
            'kits' => $branch->kits,
            'branch_name' => $branch->Name, 
            'selected_menu' => 'main-menu-home'
        ));
    }
}

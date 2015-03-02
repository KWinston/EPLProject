<?php

class HomeController extends BaseController {


    public function index()
    {
        $branch = Branches::find(Session::get('branch'));
        return View::make('home', array('kits' =>$branch->kits,'branch_name' =>$branch->Name, 'selected_menu' => 'main-menu-home'));
    }

}

<?php

class MasterController extends BaseController {

    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        if (Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            return Redirect::route('home.index');
        }
        $branches = Branches::all();

        return View::make("home", []);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::route('home.index');
    }

    public function select_branch()
    {
        if(!Request::ajax())
            return "not a json request";

        $data = Input::all();
        Session::put('branch', $data['branch']);
        return $data['branch'];
    }

    public function get_branches()
    {
        $branches = Branches::all();
        $res = "";
        foreach ($branches as $branch)
        {
            $res = $res . "<option value=\"" . $branch->ID . "\">" . $branch->BranchID . "</option>";
        }
        return $res;
    }
}

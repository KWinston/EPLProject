<?php

class MasterController extends BaseController {

    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        if (Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            // set the session variable to the current branch
            $user = Auth::user();
            Session::put('branch', $user->home_branch);
            return Redirect::action('HomeController@index', []);
        }
        return View::make("home", []);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::action('HomeController@index');
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
            $res = $res."<option value=\"".$branch->ID."\">".$branch->BranchID."</option>";
        }
        return $res;
    }
}

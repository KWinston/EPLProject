<?php

class MasterController extends BaseController {

    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        if (Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            return Redirect::action('HomeController@index', []);
        }
        // set the session variable to the current branch
        $user = Auth::user();
        Session::put('branch', $data[$user->home_branch]);
        return View::make("HomeContoller@index", []);
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

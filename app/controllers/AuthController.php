<?php

class AuthController extends BaseController {

    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        if (Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            return Redirect::route('home.index');
        }
        return View::make("home.index", []);
    }

    public function logout() {
        Auth::logout();
        return Redirect::route('home.index');
    }

}
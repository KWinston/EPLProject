<?php
include('Globals/GlobalFunctions.php');

class AdminController extends BaseController {

    public function index()
    {
        return CheckIfAuthenticated('administrator.admin',[ ], 'home.index', [], true);
    }
}

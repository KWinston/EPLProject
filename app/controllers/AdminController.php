<?php
include('Globals/GlobalFunctions.php');

class AdminController extends BaseController {

    public function index()
    {
        return CheckIfAuthenticated('administrator.logs', ['selected_menu' => 'main-menu-administration', 'selected_admin_menu' => 'admin-menu-logs'], 'home.index', [], true);
    }
}

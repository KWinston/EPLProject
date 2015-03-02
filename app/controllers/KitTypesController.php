<?php
include('Globals/GlobalFunctions.php');

class KitTypesController extends BaseController
{

    // ---------------------------------------------------------------------------------------------------
    // Show the types managment page
    public function index()
    {
        return CheckIfAuthenticated('administrator.kitTypeManagment', ['selected_menu' => 'main-menu-administration', 'selected_admin_menu' => 'admin-menu-manage-kit-types'], 'home.index', [], true);
    }

    // ---------------------------------------------------------------------------------------------------
    // Show the types Edit form
    public function show($kitTypeID)
    {
        return "Show Kit edit form";
    }
}

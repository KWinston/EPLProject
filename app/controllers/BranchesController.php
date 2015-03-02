<?php
include('Globals/GlobalFunctions.php');

class BranchesController extends BaseController
{
    // ---------------------------------------------------------------------------------------------------
    // Show the Branches managment page
    public function index()
    {
        return CheckIfAuthenticated('administrator.branchsManagment', ['selected_menu' => 'main-menu-administration', 'selected_admin_menu' => 'admin-menu-manage-branches'], 'home.index', [], true);

    }

    // ---------------------------------------------------------------------------------------------------
    // Show the branches Edit form
    public function show($branchID)
    {
        return "Show Kit edit form";
    }

}

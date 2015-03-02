<?php
include('Globals/GlobalFunctions.php');

class OverviewKitController extends BaseController {

	function index()
	{
		return CheckIfAuthenticated('members.overviewkit',[ 'selected_menu' => 'main-menu-overview'], 'home.index', [], false);
	}
}

<?php
include('Globals/GlobalFunctions.php');

class OverviewKitController extends BaseController {

	function index()
	{
		return CheckIfAuthenticated('members.overviewkit',[], 'home.index', [], false);
	}
}
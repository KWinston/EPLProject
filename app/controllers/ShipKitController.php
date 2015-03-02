<?php
include('Globals/GlobalFunctions.php');

class ShipKitController extends BaseController {

	public function index()
	{
		return CheckIfAuthenticated('members.shipkit',[ 'selected_menu' => 'main-menu-ship'], 'home.index', [], false);
	}
}

<?php
include('GlobalFunctions.php');

class ShipKitController extends BaseController {

	public function index()
	{
		return CheckIfAuthenticated('members.shipkit',[], 'home.index', [], false);
	}
}
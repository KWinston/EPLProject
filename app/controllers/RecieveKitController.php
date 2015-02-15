<?php
include('GlobalFunctions.php');

class RecieveKitController extends BaseController {

	public function index()
	{
		return CheckIfAuthenticated('members.recievekit',[], 'home.index', [], false);
	}
}
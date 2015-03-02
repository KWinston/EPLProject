<?php
include('Globals/GlobalFunctions.php');

class RecieveKitController extends BaseController {

	public function index()
	{
		return CheckIfAuthenticated('members.recievekit',[ 'selected_menu' => 'main-menu-receive'], 'home.index', [], false);
	}
}

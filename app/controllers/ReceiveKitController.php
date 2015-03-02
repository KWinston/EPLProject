<?php
include('Globals/GlobalFunctions.php');

class ReceiveKitController extends BaseController {

	public function index()
	{
		return CheckIfAuthenticated('members.receivekit',[], 'home.index', [], false);
	}
}
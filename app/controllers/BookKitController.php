<?php
include('GlobalFunctions.php');

class BookKitController extends BaseController {

	public function index()
	{
		return CheckIfAuthenticated('members.bookkit',[], 'home.index', [], false);
	}
}
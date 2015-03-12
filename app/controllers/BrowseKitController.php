<?php

class BrowseKitController extends BaseController {


	public function index()
	{
		$kits = Kits::get();
		return View::make('members/browsekit')->with('kits',$kits);
	}




}

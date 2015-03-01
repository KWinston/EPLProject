<?php

class HomeController extends BaseController {

	public function home()
	{
		$current_branch = Session::get('branch');
		$kits = DB::table('Kits')->get();
		return View::make('home')->with('kits',$kits);
	}

}

<?php

class HomeController extends BaseController {

	public function home()
	{
		$current_branch = Session::get('branch');
		$branches = DB::table('Branches')->get();
		$branch_name = "";
		foreach ($branches as $branch){
			if ($branch->ID == $current_branch)
				$branch_name = $branch->Name;
		}
		$kits = DB::table('Kits')->get();
		return View::make('home', array('kits' =>$kits,'branch_name' =>$branch_name, 'selected_menu' => 'main-menu-home'));
	}

}

<?php
function CheckIfAuthenticated($page, $pageParams, $reroute, $rerouteParams, $isAdminPage)
{
	if(!Auth::check())
		return Redirect::route($reroute);

	$adminPage = $isAdminPage ? 1 : 0;
	if (!(Auth::user()->is_admin >= $adminPage))
		return Redirect::route($reroute, $rerouteParams);

	return View::make($page, $pageParams);
}
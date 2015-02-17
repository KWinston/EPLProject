<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// add resources
Route::resource('home', 'HomeController');
//Route::resource('authenticate', 'AuthController');

Route::resource('book_kit', 'BookKitController');
Route::resource('recieve_kit', 'RecieveKitController');
Route::resource('ship_kit', 'ShipKitController');
Route::resource('overview_kit', 'OverviewKitController');

// **************** authentication *************************
Route::post("master.login", array( 
	'as'   => 'master.login', 
	'uses' => "MasterController@login"
));

Route::get('master.logout', array( 
	'as'   => 'master.logout', 
	'uses' => "MasterController@logout"
));

// **************** general ********************************

Route::post('master.select_branch', array( 
	'as'   => 'master.select_branch', 
	'uses' => "MasterController@select_branch"
));

Route::get('/', function()
{
	return View::make('home');
});




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
Route::post("authenticate.login", array( 
	'as'   => 'authenticate.login', 
	'uses' => "AuthController@login"
));
Route::get('authenticate.logout', array( 
	'as'   => 'authenticate.logout', 
	'uses' => "AuthController@logout"
));

// **************** general ********************************
Route::get('/', function()
{
	return View::make('home');
});



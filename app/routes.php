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

Route::resource('book_kit', 'BookKitController');
Route::resource('recieve_kit', 'RecieveKitController');
Route::resource('ship_kit', 'ShipKitController');
Route::resource('overview_kit', 'OverviewKitController');
Route::resource('admin', 'AdminController');


// **************** authentication *************************
Route::post("master.login", array(
	'as'   => 'master.login',
	'uses' => "MasterController@login"
));

Route::get('master.logout', array(
	'as'   => 'master.logout',
	'uses' => "MasterController@logout"
));

// **************** booking kit ****************************
Route::post('book_kit.get_shadow_days', array(
	'as'   => 'book_kit.get_shadow_days',
	'uses' => "BookKitController@get_shadow_days"
));

// **************** general ********************************

Route::post('master.select_branch', array(
	'as'   => 'master.select_branch',
	'uses' => "MasterController@select_branch"
));
Route::get('master.branches', array(
    'as'   => 'master.branches',
    'uses' => "MasterController@get_branches"
));

// **************** general ********************************
Route::get('logs.show1.{LogKey1}', array(
    'as'   => 'logs.show1',
    'uses' => "LogsController@show1"
));
Route::get('logs.show2.{LogKey1}.{LogKey2?}', array(
    'as'   => 'logs.show2',
    'uses' => "LogsController@show2"
));

Route::get('/', function()
{
	return View::make('home');
});

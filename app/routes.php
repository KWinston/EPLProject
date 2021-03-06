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
Route::resource('home', 'HomeController@index');
Route::resource('book_kit', 'BookKitController');
Route::resource('recieve_kit', 'RecieveKitController');
Route::resource('ship_kit', 'ShipKitController');
Route::resource('overview_kit', 'OverviewKitController');
Route::resource('admin', 'AdminController');
Route::resource('branches', 'BranchesController');
Route::resource('kits', 'KitsController');
Route::resource('kit_contents', 'KitContentsController');
Route::resource('kitTypes', 'KitTypesController');
Route::resource('browse_kit', 'BrowseKitController@index');
Route::resource('users', 'UsersController');



Route::get('home.getInventory', array(
    'as' => 'home.getInventory',
    'uses' => 'HomeController@getInventory'
    ));

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

Route::post('book_kit.get_kit_bookings', array(
	'as'   => 'book_kit.get_kit_bookings',
	'uses' => "BookKitController@getKitBookings"
));

Route::post('book_kit.get_type_bookings', array(
	'as'   => 'book_kit.get_type_bookings',
	'uses' => "BookKitController@getTypeBookings"
));

Route::post('book_kit.get_available_kit', array(
	'as'   => 'book_kit.get_available_kit',
	'uses' => "BookKitController@getAvailableKit"
));

Route::post('book_kit.get_shadow_days', array(
	'as'   => 'book_kit.get_shadow_days',
	'uses' => "BookKitController@getShadowDays"
));

Route::post('book_kit.insert_booking', array(
	'as'   => 'book_kit.insert_booking',
	'uses' => "BookKitController@insertBooking"
));

Route::post('book_kit.update_booking', array(
	'as'   => 'book_kit.update_booking',
	'uses' => "BookKitController@updateBooking"
));

Route::post('book_kit.delete_booking', array(
	'as'   => 'book_kit.delete_booking',
	'uses' => "BookKitController@deleteBooking"
));

// ********** Kit Contents ********************************
Route::get('kit_contents.contents.{KitID}', array(
    'as'   => 'kit_contents.contents',
    'uses' => "KitContentsController@contents"
));
// ****************** Kits ********************************
Route::get('kits.kitDetails.{KitID}', array(
    'as'   => 'kits.kitDetails',
    'uses' => "KitsController@kitDetails"
));

// ************** Master Page *****************************

Route::post('master.select_branch', array(
	'as'   => 'master.select_branch',
	'uses' => "MasterController@select_branch"
));

Route::get('master.branches', array(
    'as'   => 'master.branches',
    'uses' => "MasterController@get_branches"
));

Route::get('logs.show1.{LogKey1}', array(
    'as'   => 'logs.show1',
    'uses' => "LogsController@show1"
));
Route::get('logs.show2.{LogKey1}.{LogKey2?}', array(
    'as'   => 'logs.show2',
    'uses' => "LogsController@show2"
));

Route::get('/', 'HomeController@index');

// **************** receive and ship kit ****************

Route::get('ship_kit.findKit.{theKitID}', array(
	'as'   => 'ship_kit.findKit',
	'uses' => 'ShipKitController@findKit'
));

Route::get('ship_kit.shipOut', array(
	'as'   => 'ship_kit.shipOut',
	'uses' => 'ShipKitController@shipOut'
));

Route::get('recieve_kit.findKit.{theKitID}', array(
	'as'   => 'recieve_kit.findKit',
	'uses' => 'RecieveKitController@findKit'
));

Route::post('recieve_kit.confirmReceive', array(
	'as'   => 'recieve_kit.confirmReceive',
	'uses' => 'RecieveKitController@confirmReceive'
));
// **************** general ********************************
Route::get('help.page.{topic}', array(
    'as'   => 'help.page',
    'uses' => "HelpController@page"
));

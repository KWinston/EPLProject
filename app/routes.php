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
Route::resource('book_kit', 'BookKitController');
Route::resource('recieve_kit', 'RecieveKitController');
Route::resource('ship_kit', 'ShipKitController');

Route::resource('authenticate', 'AuthController');

Route::resource('main', 'UserController');

Route::get('/', function()
{
	return View::make('hello');
});

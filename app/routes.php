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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('user', 'HomeController@showLoginPage');
Route::post('user/login', array('before' => 'csrf', 'uses' => 'HomeController@handleUserLogin'));

// this is the authenticated section
Route::group(array('before' => 'checkAuthUser'), function() {
    Route::get('dashboard', 'HomeController@showUserDashboard');
    Route::get('user/logout', 'HomeController@handleUserLogout');
});

Route::filter('checkAuthUser', function() {
    if (!Auth::check())
        return Redirect::to('user');
});
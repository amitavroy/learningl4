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

Route::get('blog', 'HomeController@blogHome');

// multiple segment route - https://github.com/laravel/framework/issues/150
Route::get('blog/{segments}', 'HomeController@singlePost')->where('segments', '(.*)');
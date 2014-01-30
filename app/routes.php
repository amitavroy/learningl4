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

/*Route::get('blog', function() 
{
  $blog = new Blog;
  $lastestBlogs = $blog->getLatestBlogs();
  $blogs = $blog->getBlogs($lastestBlogs);
  // return Response::json($blogs, 200);
  echo "<pre>" . print_r($blogs, true);
});*/

Route::get('blog', 'HomeController@blogHome');
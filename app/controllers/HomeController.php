<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'html';

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function blogHome()
	{
		$blog = new Blog;
		$lastestBlogs = $blog->getLatestBlogs();
		$blogs = $blog->getBlogs($lastestBlogs);

		$this->layout->content = View::make('blog.blog-home')->with('blogs', $blogs);
	}

	public function singlePost($alias)
	{
		$segments = explode('/', $alias);
		$nodeId = $segments[count($segments) - 1];
		$blog = new Blog();
		$thisBlogPost = $blog->getBlogs($nodeId);
		$this->layout->content = View::make('blog.blog-post')->with('post', $thisBlogPost);
	}

}
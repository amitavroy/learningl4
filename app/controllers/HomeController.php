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

	protected $layout = 'master.page';

	/**
	 * This is the default welcome page of Laravel.
	 * @return Response
	 */
	public function showWelcome()
	{
		$this->layout = '';
		return View::make('hello');
	}

	/**
	 * Controller to handle the login page
	 * @return Response
	 */
	public function showLoginPage()
	{
		$this->layout->content = View::make('user.user_login');
	}

	/**
	 * Handling the post data from login form 
	 * and checking authentication.
	 * @return Response redirect
	 */
	public function handleUserLogin()
	{
		// fetch the post data
		$postData = Input::all();

		// credentails array
		$credentials = array('email' => $postData['username'], 'password' => $postData['password']);

		// checking the authentication
		if (Auth::attempt($credentials))
		{
		    return Redirect::intended('dashboard');
		}
		else
		{
			return Redirect::back();
		}
	}

	public function handleUserLogout()
	{
		Auth::logout();
		
		return Redirect::to('user');
	}

	/**
	 * Handling the user dashboard page
	 * @return Response
	 */
	public function showUserDashboard()
	{
		$this->layout->content = View::make('user.user_dashboard');
	}
}

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

	public function registerFormPage()
	{
		$this->layout->content = View::make('form.register');
	}

	public function saveRegistration()
	{
		// getting all of the post data
		$postData = Input::all();

		// setting up custom error messages for the field validation
		$messages = array(
			'email.required' => 'We need to know your email address',
			'firstname.required' => 'Please enter your full first name',
			'lastname.required' => 'Please enter your full last name',
			'password.required' => 'You have to set a password',
			'cpassword.required' => 'Write is again so that you are sure about your password',
			'cpassword.matchpass' => 'The two passwords does not match', // this is for the custom validatio that we have written
		);

		$rules = array(
			'email' => 'required|email',
			'firstname' => 'required|min:3',
			'lastname' => 'required',
			'password' => 'required',
			'cpassword' => 'required|Matchpass:' . $postData["password"],
		);

		// doing the validation, passing post data, rules and the messages
		$validator = Validator::make($postData, $rules, $messages);


		if ($validator->fails())
		{
			// send back to the page with the input data and errors
			GlobalHelper::setMessage('Fix the errors.', 'warning'); // settig the error message
			return Redirect::to('register')->withInput()->withErrors($validator);
		}
		else
		{
			// send back to the page with success message
			GlobalHelper::setMessage('Registration data saved.', 'success');
			return Redirect::to('register');
		}
	}

}
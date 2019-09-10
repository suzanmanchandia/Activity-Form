<?php

class LoginController extends BaseController {

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

	public function index()
	{
		if (!Auth::guest())
		{
			return Redirect::route('entries.index');
		}

		$this->layout->content = View::make('login.index');
	}


	public function action()
	{
		$validation = Validator::make(Input::all(), array(
			'email'    => 'required|email',
			'password' => 'required',
		));

		if ($validation->fails())
		{
			Notification::error($validation->errors()->all());
			return Redirect::refresh()->withInput();
		}

		if (!Auth::attempt(Input::only('email', 'password'), Input::has('remember')))
		{
			Notification::error('Invalid email or password.');
			return Redirect::back()->withInput();
		}

		return Redirect::intended(route('entries.index'));
	}

	/**
	 * Logout
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout()
	{
		Auth::logout();

		return Redirect::route('login');
	}

}

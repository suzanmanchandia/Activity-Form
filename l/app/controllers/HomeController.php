<?php

use Illuminate\Mail\Message;

class HomeController extends BaseController {

	/**
	 * @var Staff $staff
	 */
	protected $staff;

	public function __construct(Staff $staff)
	{
		parent::__construct();
		$this->staff = $staff;
	}

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
		$this->layout->content = View::make('home.index');
	}


	public function loginAction()
	{
		$validation = Validator::make(Input::all(), array(
			'email'  => 'required|email',
			'pin'    => 'required',
		));

		if ($validation->fails())
		{
			Notification::error($validation->errors()->all());
			return Redirect::back()->withInput();
		}

		$email = Input::get('email');
		$pin   = Input::get('pin');
		$staff = $this->staff;
		$staff = $staff->whereEmail($email)->first();

		if (!$staff)
		{
			Notification::error('Invalid username. Please register.');
			return Redirect::back()->withInput();
		}
		elseif ($staff->pin != $pin)
		{
			Notification::error('Invalid password.');
			return Redirect::back()->withInput();
		}

		Session::set('staff', $staff->id);

		return Redirect::route('form.create');
	}

	public function logout()
	{
		Session::remove('staff');

		return Redirect::route('staff.login');
	}

	/**
	 * Forgot password
	 */
	public function forgot()
	{
		$this->layout->content = View::make('home.forgot');
	}

	/**
	 * Forgot password
	 */
	public function forgotAction()
	{
		$email = Input::get('email');
		
		if (!($email and filter_var($email, FILTER_VALIDATE_EMAIL))) {
			Notification::error('Invalid email address.');
			return Redirect::route('staff.forgot')->withInput();
		}
		
		$staff = $this->staff->whereEmail($email)->first();

		if (!$staff) {
			Notification::error('Sorry we could not find that email address.');
			return Redirect::route('staff.forgot')->withInput();
		}
		$data = ['staff' => $staff];
		
		try
		{
		    Mail::send('emails.auth.forgot.staff', $data, function(Message $message) use($staff) {
				$message->to($staff->email);
				$message->subject('Faculty Activity Form: PIN Request');
			});
			if (Config::get('mail.pretend')) Log::info(View::make('emails.auth.forgot.staff', $data)->render());
              

			/**Mail::send('emails.staff.forgot', $data, function(Message $message) use ($staff, $pin, $data) {
				$message->to($staff->email);
				$message->subject('Faculty Activity Form: PIN Request');
			});
			if (Config::get('mail.pretend')) Log::info(View::make('emails.forgot.staff', $data)->render());*/
			Notification::success('Your password has been sent. Please login below.');
			return Redirect::route('staff.login')->withInput();
		}
		catch (Exception $e)
		{
			Notification::error('There was an error sending your information.');
			return Redirect::route('staff.forgot')->withInput();
		}

	}

	/**
	 * Register
	 */
	public function register()
	{
		$this->layout->content = View::make('home.register');
	}

	/**
	 * Register post action
	 */
	public function registerAction()
	{

		$validation = Validator::make(Input::all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:staff',
			'password' => 'required|min:4|confirmed',
		],[
			'email.unique' => sprintf('The email has already been taken. <a href="%s">Click here to retrieve your password</a>', route('staff.forgot'))
		]);

		if ($validation->fails()) {
			Notification::error(sprintf('Please correct the following errors:<br>%s', join('<br>', $validation->errors()->all())));
			return Redirect::route('register')->withInput();
		}

		Staff::unguard();

		$staff = $this->staff;
		$staff->fill(Input::only('first_name', 'last_name', 'email'));
		$staff->pin = Input::get('password');
		$staff->save();

		Notification::success('You have successfully registered. Please login below');
		return Redirect::route('staff.login')->withInput();
	}

}

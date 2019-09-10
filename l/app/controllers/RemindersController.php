<?php

class RemindersController extends BaseController {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		$this->layout->content = View::make('login.forgot');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$callback = function($mail, $user, $token) {
			$data = [
				'token' => $token
			];
			if (Config::get('mail.pretend')) Log::info(View::make('emails.auth.reminder', $data)->render());
		};

		switch ($response = Password::remind(Input::only('email'), $callback))
		{
			case Password::INVALID_USER:
				Notification::error(Lang::get($response));
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				Notification::success(Lang::get($response));
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		$this->layout->content = View::make('login.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				Notification::error(Lang::get($response));
				return Redirect::back()->withInput();

			case Password::PASSWORD_RESET:
				Notification::success('Your password has been reset. Please login below.');
				return Redirect::route('login');
		}
	}

}

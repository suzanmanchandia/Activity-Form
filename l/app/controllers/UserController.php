<?php

class UserController extends \Roski\AdminController {

	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->orderBy('last_name')->orderBy('first_name');

		$this->layout->content = View::make('users.index', [
			'users' => $users->paginate()
		]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = $this->user;

		$this->layout->content = View::make('users.create', [
			'user' => $user
		]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = $this->user;

		$validation = Validator::make(Input::all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'user_rank' => 'required',
		]);

		if ($validation->fails()) {
			return $this->errorResponse($validation->errors()->all());
		}

		User::unguard();

		$user->fill(Input::only('first_name', 'last_name', 'email','user_rank'));

		$user->password = Hash::make(Input::get('password'));

		User::reguard();

		$user->save();

		return Response::json([
			'message' => 'The user has been created. You will be redirected shortly.',
			'redirect' => route('users.index')
		]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);

		if (!$user)
		{
			Notification::error('The user you tried to edit was not found.');
			return Redirect::route('users.index');
		}

		$this->layout->content = View::make('users.edit', [
			'user' => $user
		]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = $this->user->find($id);

		if (!$user)
		{
			return $this->errorResponse(['The user you tried to edit was not found.']);
		}

		$validation = Validator::make(Input::all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email'
			//'user_rank' => 'required'
		]);

		if ($validation->fails()) {
			return $this->errorResponse($validation->errors()->all());
		}

		User::unguard();

		$user->fill(Input::only('first_name', 'last_name', 'email','user_rank'));

		$user->password = Hash::make(Input::get('password'));

		User::reguard();

		$user->save();

		return Response::json([
			'message' => 'The user has been updated. You will be redirected shortly.',
			'redirect' => route('users.index')
		]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->user->find($id);

		if (!$user)
		{
			Notification::error('The user you tried to delete was not found.');
			return Redirect::route('users.index');
		}

		if ($user->id == Auth::id()) {
			Notification::error('You cannot delete yourself, buddy!');
			return Redirect::route('users.index');
		}

		$user->delete();
		Notification::succes('You cannot delete yourself, buddy!');
		return Redirect::route('users.index');
	}


}

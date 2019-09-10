<?php

class FormController extends \Roski\StaffController {

	/**
	 * @var Staff $staff
	 */
	protected $staff;
	/**
	 * @var Entry $entry
	 */
	protected $entry;

	public function __construct(Staff $staff, Entry $entry)
	{
		parent::__construct();
		$this->staff = $staff->find(Session::get('staff'));
		$this->entry = $entry;

		View::share('staff', $this->staff);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$entry = $this->staff->currentEntry();

		if ($entry->submitted) {
			return Redirect::route('form.review');
		}

		$this->layout->content = View::make('form.index', array(
			'entry' => $entry
		));
	}

	/**
	 * @param string $field
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function upload($field)
	{
		$entry = $this->staff->currentEntry();

		if (count($entry->existingFiles($field)))
		{
			return Response::json(['error' => 'Sorry, a file already exists.'], 400);
		}

		$input = Input::all();
		$rules = array(
			'file' => 'required|max:3000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::json(['error' => $validation->errors->first()], 400);
		}

		$file = Input::file('file');

		$extension = $file->getClientOriginalExtension();
		$directory = public_path('packages/uploads');
		$filename = sha1($field.$entry->id).".{$extension}";

		$upload_success = Input::file('file')->move($directory, $filename);

		if( $upload_success ) {
			return Response::json('success', 200);
		} else {
			return Response::json(array('error' => 'Unable to upload file.'), 400);
		}
	}

	/**
	 * @param string $field
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function removeUpload($field)
	{
		$entry = $this->staff->currentEntry();

		$files = glob(public_path('packages/uploads/').sha1($field.$entry->id).'.*');

		// Delete all files matching
		if (!empty($files))
		{
			array_map('unlink', $files);
		}

		return Response::json('success', 200);
	}


	/**
	 * @param string $field
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function uploadEdit($field,$id)
	{
		$entry = $this->staff->entries()->find($id);

		if (count($entry->existingFiles($field)))
		{
			return Response::json(['error' => 'Sorry, a file already exists.'], 400);
		}

		$input = Input::all();
		$rules = array(
			'file' => 'required|max:3000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::json(['error' => $validation->errors->first()], 400);
		}

		$file = Input::file('file');

		$extension = $file->getClientOriginalExtension();
		$directory = public_path('packages/uploads');
		$filename = sha1($field.$entry->id).".{$extension}";

		$upload_success = Input::file('file')->move($directory, $filename);

		if( $upload_success ) {
			return Response::json('success', 200);
		} else {
			return Response::json(array('error' => 'Unable to upload file.'), 400);
		}
	}

	/**
	 * @param string $field
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function removeUploadEdit($field,$id)
	{
		$entry = $this->staff->entries()->find($id);

		$files = glob(public_path('packages/uploads/').sha1($field.$entry->id).'.*');

		// Delete all files matching
		if (!empty($files))
		{
			array_map('unlink', $files);
		}

		return Response::json('success', 200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$entry = $this->staff->currentEntry();

		$fields = array_except($entry->getAttributes(), ['_token', 'id', 'staff_id', 'initials', 'date', 'submitted', Entry::CREATED_AT, Entry::UPDATED_AT]);
		$fields = array_keys($fields);

		// Jury and panel discussions have been consolidated
		foreach (range(1,3) as $counter)
		{
			unset($fields['panel'.$counter]);
			unset($fields['jury'.$counter]);
		}

		$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'rank' => 'required',
			'period' => sprintf('required|unique:entries,period,%d,id,staff_id,%d', $entry->id, $this->staff->id),
		);

		$messages = array(
			'period.unique' => sprintf('You have already made a submission for the %s period.', Input::get('period')),
			'rank.required' => sprintf('You have to input your rank'),
		);

		if (Input::get('confirm'))
		{
			$rules['initials'] = 'required|min:2';
			$rules['date']     = 'required|date';
			$fields            = array_merge($fields, ['initials', 'date']);
			
			$entry->submitted  = true;
		}

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails())
		{
			return $this->errorResponse($validation->errors()->all());
		}

		Entry::unguard();

		$this->staff->update(Input::only(['first_name', 'last_name']));

		$entry->fill(Input::only($fields));

		$entry->save();
		
		if (Input::get('confirm'))
		{
		    
		    return Response::json([
				'message' => 'Your entry has been submitted. You will be redirected shortly.',
				'redirect' => route('form.print', $entry->id)
			]);
		}
		
		return $this->successResponse('Your entry has been saved.');
	}

	/**
	 *
	 */
	public function review()
	{
		$entries = $this->staff->entries()->where('submitted', '=', 1)->orderBy('period','desc')->get();

		$this->layout->content = View::make('form.review', array(
			'entries' => $entries,
		));
	}


	/**
	 * Create the specified resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$entry = $this->staff->currentEntry();

		if ($entry->submitted)
		{
			Entry::unguard();
			$old   = $entry;
			$entry = clone $this->entry;
			$entry->fill(array_only($old->getAttributes(), [
				'rank',
			]));
			$entry->staff()->associate($this->staff)->save();
		}

		return Redirect::route('form.review');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function password()
	{
		$this->layout->content = View::make('form.password');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function updatePassword()
	{
		$staff = $this->staff;

		$validation = Validator::make(Input::all(), [
			'old' => 'required|exists:staff,pin,id,'.$staff->id,
			'password' => 'required|confirmed',
		], [
			'old.exists' => 'Your old password is invalid',
		]);

		if ($validation->fails()) {
			Notification::error($validation->errors()->all());
			return Redirect::route('staff.password')->withErrors($validation->errors());
		}

		$staff->pin = Input::get('password');
		$staff->save();

		Notification::success('Your password was updated successfully.');
		return Redirect::route('staff.password');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pdf($id)
	{
		$entry = $this->staff->entries()->find($id);
		/* @var $entry Entry */

		if (!$entry) {
			return Redirect::route('form.review');
		}

		$pdf = new mPDF();

		$pdf->writeHTML(View::make('entries.pdf', array('entry' => $entry))->render());

		return Response::make($pdf->Output(), 200, array(
			'Content-type' => 'application/pdf'
		));
	}

	/**
	 * Show edit the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
 	public function edit($id)
	{
		$entry = $this->staff->entries()->find($id);

		if (!$entry) {
			return Redirect::route('form.review');
		}

		$this->layout->content = View::make('form.edit', array(
			'entry' => $entry,
		));
	}


	/**
	 * Update a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$entry = $this->staff->entries()->find($id);

		$fields = array_except($entry->getAttributes(), ['_token', 'id', 'staff_id', 'initials', 'date', 'submitted', Entry::CREATED_AT, Entry::UPDATED_AT]);
		$fields = array_keys($fields);

		// Jury and panel discussions have been consolidated
		foreach (range(1,3) as $counter)
		{
			unset($fields['panel'.$counter]);
			unset($fields['jury'.$counter]);
		}

		$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'rank' => 'required'
			#'period' => sprintf('required|unique:entries,period,%d,id,staff_id,%d', $entry->id, $this->staff->id),
		);

		$messages = array(
			#'period.unique' => sprintf('You have already made a submission for the %s period.', Input::get('period')),
			'rank.required' => sprintf('You have to input your rank'),
		);

		if (Input::get('confirm'))
		{
			$rules['initials'] = 'required|min:2';
			$rules['date']     = 'required|date';
			$fields            = array_merge($fields, ['initials', 'date']);
		}

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails())
		{
			return $this->errorResponse($validation->errors()->all());
		}

		Entry::unguard();

		$this->staff->update(Input::only(['first_name', 'last_name']));

		$entry->fill(Input::only($fields));

		$entry->edited  = true;

		$entry->save();
		
		if (Input::get('confirm'))
		{
			return Response::json([
				'message' => 'Your entry has been saved. You will be redirected shortly.',
				'redirect' => route('form.print', $entry->id)
			]);
		}

		return $this->successResponse('Your entry has been saved.');
	}

}

<?php

use Illuminate\Mail\Message;

class EntryController extends \Roski\AdminController {

	public function __construct(Entry $entry, Staff $staff)
	{
		parent::__construct();
		$this->entry = $entry;
		$this->staff = $staff;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		/**
		 * Show entries based on reviewer rank
		 * Tenure -> show everything
		 * Teaching -> show Teaching and Practice
		 * Practice -> show Practice
		 * Research/Teaching/Practice and Part-time need to be removed completely
		 * Research/Teaching/Practice -> show Part-time and Research/Teaching/Practice
		 * Part-time -> show Part-time
		 */
		switch($user->user_rank){
			case "Tenure":
				$access_rights = array("Tenure", "Teaching", "Practice", "Research/Teaching/Practice", "Part-time");
				break;
			case "Teaching":
			    $access_rights = array("Teaching", "Practice", "Research/Teaching/Practice", "Part-time");
				break;
			case "Practice":
			    $access_rights = array("Teaching", "Practice", "Research/Teaching/Practice", "Part-time");
				break;
			default:
				$access_rights = array();
		}

		$staff = clone $this->staff;

		$staff = $staff->join(DB::raw('entries e'), function($join){
			$join->on('staff.id', '=', 'e.staff_id');
			$join->where('e.submitted', '=', 1)->where('e.period', '=', 2018);
		})->whereIn('e.rank',$access_rights);

		$progress = $this->staff->join(DB::raw('entries e'), function($join){
			$join->on('staff.id', '=', 'e.staff_id');
			$join->where('e.submitted', '<>', 1)->where('e.period', '=', 2018);
		})->whereIn('e.rank',$access_rights);

		$this->layout->content = View::make('entries.index', [
			'staff' => $staff->defaultSort()->get(),
			'progress' => $progress->defaultSort()->get(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$staff = $this->staff->find($id);
		/* @var $staff Staff */

		$user = Auth::user();
		
		/**
		 * Show entries based on reviewer rank
		 * Tenure -> show everything
		 * Research/Teaching/Practice -> show Part-time and Research/Teaching/Practice
		 * Part-time -> show Part-time
		 */
		switch($user->user_rank){
		    case "Tenure":
				$access_rights = array("Tenure", "Teaching", "Practice", "Research/Teaching/Practice", "Part-time");
				break;
			case "Teaching":
			    $access_rights = array("Teaching", "Practice", "Research/Teaching/Practice", "Part-time");
				break;
			case "Practice":
			    $access_rights = array("Teaching", "Practice", "Research/Teaching/Practice", "Part-time");
				break;
			default:
				$access_rights = array();
		}

		if (!$staff) {
			App::abort(404);
		}

		$entries = $staff->entries()->where('submitted', '=', 1)->whereIn('rank',$access_rights)->orderBy('period','desc')->get();

		return Response::view('entries.show', [
			'staff' => $staff,
			'entries' => $entries,
		]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function comments($id)
	{
		$entry = $this->entry->find($id);
		/* @var $entry Entry */

		if (!$entry) {
			App::abort(404);
		}

		$comment = new Comment();

		if (!Input::get('content'))
		{
			return $this->errorResponse(['Comment content is required.']);
		}

		$comment->content = Input::get('content');
		$comment->entry()->associate($entry);
		$comment->user()->associate(Auth::getUser());

		$comment->save();

		return Response::json([
			'message' => 'Comment added!',
			'comment' => $comment->toFormatted()
		]);
	}

	public function import()
	{
		$this->layout->content = View::make('entries.import');
	}

	public function processImport()
	{
		$file  = Input::file('upload');

		$entries = $this->csv_to_array($file->getRealPath());

		DB::beginTransaction();

		try {
			//

			foreach ($entries as $e)
			{
				$staff = new Staff;

				$staff->first_name = $e['Name'];
				$staff->last_name = $e['Last'];
				$staff->email = 'N/A';
				$staff->pin = str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);

				$staff->save();

				$entry = new Entry;

				$entry->timestamps = false;

				if (!array_key_exists('Rank', $e)) {
					return $this->errorResponse([print_r($e, true)]);
				}
				$entry->rank = $e['Rank'];
				$entry->period = $e['Period Covered: January 1 - December 31'];
				$entry->tt_ntt = $e['TT / NTT'];
				$entry->fall_course1 = $e['Course 1'];
				$entry->fall_course2 = $e['Course 2 (if applicable)'];
				$entry->fall_course3 = $e['Course 3 (if applicable)'];
				$entry->spring_course1 = $e['Course 12'];
				$entry->spring_course2 = $e['Course 2 (if applicable)2'];
				$entry->spring_course3 = $e['Course 3 (if applicable)2'];
				$entry->summer_course1 = $e['Course 13'];
				$entry->summer_course2 = $e['Course 2 (if applicable)3'];
				$entry->summer_course3 = $e['Course 3 (if applicable)3'];
				$entry->independent_study = $e['Independent Study / Formal Mentoring / Thesis Committee Participation'];
				$entry->semester_reviews = $e['End of Semester Reviews'];
				$entry->admissions = $e['Admissions, Recruitment, and Conversion Efforts'];
				$entry->exhibitions = $e['Exhibitions / Commissions / Writings and Publications'];
				$entry->reviews = $e['Reviews, monographs, essays, articles, etc. written about your work. Complete bibliographic entries.'];
				$entry->lecture1 = $e['Lecture of Panel Discussion #1'];
				$entry->lecture2 = $e['Lecture of Panel Discussion #2'];
				$entry->lecture3 = $e['Lecture of Panel Discussion #3'];
				$entry->jury1 = $e['Juries and Advisory Boards #1'];
				$entry->jury2 = $e['Juries and Advisory Boards #2'];
				$entry->jury3 = $e['Juries and Advisory Boards #3'];
				$entry->research = $e['Research and Work in Progress'];
				$entry->mentoring = $e['Peer mentoring - Provide details on your mentoring of other faculty members.'];
				$entry->project1 = $e['Project, Event, or Program #1'];
				$entry->project2 = $e['Project, Event, or Program #2'];
				$entry->project3 = $e['Project, Event, or Program #3'];
				$entry->initiative1 = $e['Initiative #1'];
				$entry->initiative2 = $e['Initiative #2'];
				$entry->initiative3 = $e['Initiative #3'];
				$entry->event1 = $e['Special Event or Program #1'];
				$entry->event2 = $e['Special Event or Program #2'];
				$entry->event3 = $e['Special Event or Program #3'];
				$entry->development = $e['Academic Development'];
				$entry->work1 = $e['Cross-Disciplinary Work #1'];
				$entry->work2 = $e['Cross-Disciplinary Work #2'];
				$entry->work3 = $e['Cross-Disciplinary Work #3'];
				$entry->accomplishments = $e['Other accomplishments that you feel made a special contribution to the Roski School and/or University.'];
				$entry->comments = $e['Comments on anything else you feel is worthy of consideration for this academic period that has not been indicated above.'];
				$entry->initials = $e['By entering my initials and submitting this form, I attest that all the above information is correct.'];
				$entry->created_at = $e['Date Created'];
				$entry->submitted  = 1;
				if ($e['Last Updated']) {
					$entry->updated_at = $e['Last Updated'];
				}
				else {
					$entry->updated_at = $e['Date Created'];
				}

				$entry->staff()->associate($staff)->save();

				$entry->importFile('resume', $e['Please upload a current copy of your resume.']);
				foreach(range(1,8) as $counter) {
					$entry->importFile('syllabus'.$counter, $e['File '.$counter]);
				}

			}
			DB::commit();

			return $this->successResponse('All entries have been imported');
		}
		catch (Exception $ex) {
			DB::rollBack();
			return $this->errorResponse([$ex->getMessage()]);
		}
	}

	/**
	 * @param string $filename
	 * @param string $delimiter
	 * @return array
	 *
	 * @see https://gist.github.com/jaywilliams/385876
	 */
	private function csv_to_array($filename, $delimiter = ',')
	{
		ini_set('auto_detect_line_endings', TRUE);
		if (!file_exists($filename) || !is_readable($filename))
			return FALSE;

		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE)
			{
				if(!$header)
				{
					$header = array();
					foreach ($row as $val)
					{
						$header_raw[] = $val;
						$hcounts = array_count_values($header_raw);
						$header[] = $hcounts[$val]>1?$val.$hcounts[$val]:$val;
					}

					$header = array_map('trim', $header);
				}
				else
				{
					if (count($header) > count($row)) {
						$difference = count($header) - count($row);
						for ($i = 1; $i <= $difference; $i++) {
							$row[count($row) + 1] = $delimiter;
						}
					}
					$data[] = array_combine($header, $row);
				}
			}
			fclose($handle);
		}
		return $data;
	}


	/**
	 * Show the form for emailing the specified staff member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function email($id)
	{
		$staff = Staff::find($id);

		if (!$staff) {
			App::abort(404);
		}

		return Response::view('entries.email', array(
			'staff' => $staff,
			'user'  => Auth::getUser(),
		));
	}

	public function processEmail($id)
	{
		$staff = Staff::find($id);

		if (!$staff) {
			App::abort(404);
		}
		/* @var $staff Staff */

		$validation = Validator::make(Input::all(),
			array(
				'to' => 'required|email',
				'from' => 'required',
				'sender' => 'required|email',
				'message' => 'required',
			));

		if ($validation->fails())
		{
			return $this->errorResponse($validation->errors()->all());
		}

		Mail::send('emails.blank', array('content' => Input::get('message') ), function (Message $message) use ($staff){
			$message->subject(Input::get('subject'));
			$message->from(Input::get('sender'), Input::get('from'));
			$message->to(Input::get('to'), $staff->first_name . ' ' . $staff->last_name);

			if (Config::get('mail.pretend')) Log::info(View::make('emails.blank', array('content' => Input::get('message') ))->render());
		});

		return $this->successResponse('Message sent!');

		return Response::view('entries.email', array(
			'staff' => $staff,
			'user'  => Auth::getUser(),
		));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		$entry = Entry::find($id);
		/* @var $entry Entry */

		if (!$entry) {
			return Redirect::route('entries.index');
		}

		$pdf = new mPDF();

		$pdf->writeHTML(View::make('entries.pdf', array('entry' => $entry))->render());

		return Response::make($pdf->Output(), 200, array(
			'Content-type' => 'application/pdf'
		));
	}
	
	public function preview($id)
	{
	    $entry = Entry::find($id);
	    
	    if (!$entry) {
			return Redirect::route('entries.index');
		}
		return Response::view('entries.preview', array('entry' => $entry));
		
	}
	
}

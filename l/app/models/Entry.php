<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;


/**
 * Entry
 *
 * @property integer $id
 * @property integer $staff_id
 * @property string $rank
 * @property string $period
 * @property string $tt_ntt
 * @property string $fall_course1
 * @property string $fall_course2
 * @property string $fall_course3
 * @property string $spring_course1
 * @property string $spring_course2
 * @property string $spring_course3
 * @property string $summer_course1
 * @property string $summer_course2
 * @property string $summer_course3
 * @property string $independent_study
 * @property string $efforts
 * @property string $semester_reviews
 * @property string $admissions
 * @property string $exhibitions
 * @property string $reviews
 * @property string $lecture1
 * @property string $lecture2
 * @property string $lecture3
 * @property string $panel_discussions
 * @property string $jury1
 * @property string $jury2
 * @property string $jury3
 * @property string $juries_advisory
 * @property string $research
 * @property string $mentoring
 * @property string $university_committee1
 * @property string $university_committee2
 * @property string $university_committee3
 * @property string $project1
 * @property string $project2
 * @property string $project3
 * @property string $initiative1
 * @property string $initiative2
 * @property string $initiative3
 * @property string $roski_committee1
 * @property string $roski_committee2
 * @property string $roski_committee3
 * @property string $event1
 * @property string $event2
 * @property string $event3
 * @property string $development
 * @property string $work1
 * @property string $work2
 * @property string $work3
 * @property string $accomplishments
 * @property string $comments
 * @property string $initials
 * @property string $date
 * @property boolean $submitted
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Entry whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereStaffId($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereRank($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry wherePeriod($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereFallCourse1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereFallCourse2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereFallCourse3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSpringCourse1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSpringCourse2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSpringCourse3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSummerCourse1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSummerCourse2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSummerCourse3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereIndependentStudy($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereEfforts($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereAdmissions($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereExhibitions($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereReviews($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereLecture1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereLecture2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereLecture3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereJury1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereJury2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereJury3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereResearch($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereMentoring($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereUniversityCommittee1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereUniversityCommittee2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereUniversityCommittee3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereProject1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereProject2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereProject3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereInitiative1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereInitiative2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereInitiative3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereRoskiCommittee1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereRoskiCommittee2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereRoskiCommittee3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereEvent1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereEvent2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereEvent3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereDevelopment($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereWork1($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereWork2($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereWork3($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereAccomplishments($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereInitials($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereSubmitted($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Entry whereUpdatedAt($value)
 * @property-read \Staff $staff
 * @method static \Entry defaultSort()
 */
class Entry extends \Roski\Model {

	use SoftDeletingTrait;

	protected $hidden = array('submitted');

	/**
	 * Staff who made the entry
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function staff()
	{
		return $this->belongsTo('Staff');
	}

	/**
	 * Associated comments
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeDefaultSort($query)
	{
		return $query->orderBy($this->table.'.'.static::CREATED_AT, 'DESC');
	}

	/**
	 * File name
	 * @param $field
	 * @param $name
	 * @return array
	 */
	public function existingFiles($field, $name = null)
	{
		$files = glob(public_path('packages/uploads/').sha1($field.$this->id).'.*');

		$results = [];

		foreach ($files as $file)
		{
			$results[] = [
				'name' => basename($file),
				'size' => filesize($file),
				'accepted' => true,
				'status' => 'success'
			];
		}

		return $results;
	}

	/**
	 * File name
	 * @param $field
	 * @param $name
	 * @return string
	 */
	public function existingFilesJson($field, $name = null)
	{
		return json_encode($this->existingFiles($field, $name));
	}

	public function importFile($field, $value)
	{
		$pattern = '/^([^\(]+)\(([^\)]+)\)/';
		$value = trim($value);

		$value = str_replace('https', 'http', $value);

		if (!($value && preg_match($pattern, $value))) {
			return;
		}
		// Get only url from value.
		// Remove everything up to and including the first parenthesis
		// Remove the last parenthesis
		$url = preg_replace($pattern, '$2', $value);

		$extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
		$file      = sprintf('%s/%s.%s', public_path('packages/uploads'), sha1($field.$this->id), $extension);

		$client = new GuzzleHttp\Client();
		$client->get($url, ['save_to' => $file]);
	}

	/**
	 * @return array
	 */
	public function formattedComments()
	{
		$results = array();

		foreach ($this->comments()->defaultSort()->get() as $comment)
		{
			$results[] = $comment->toFormatted();
		}

		return $results;
	}

}

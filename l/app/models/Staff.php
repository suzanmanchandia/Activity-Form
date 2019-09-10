<?php


/**
 * Staff
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $pin
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Staff whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Staff whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Staff wherePin($value)
 * @method static \Illuminate\Database\Query\Builder|\Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Staff defaultSort()
 * @property-read \Illuminate\Database\Eloquent\Collection|\Entry[] $entries
 */
class Staff extends \Roski\Model {

	protected $table = 'staff';
	protected $hidden = array('pin');
	protected $fillable = array('email', 'pin');

	/**
	 * Associated comments
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function entries()
	{
		return $this->hasMany('Entry');
	}

	/**
	 * @param \Illuminate\Database\Query\Builder $query
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function scopeDefaultSort($query)
	{
		return $query->join('entries', 'entries.staff_id', '=', 'staff.id')
			->orderBy('first_name')->orderBy('last_name')
			->select('staff.*')
			->groupBy('entries.staff_id');
	}

	/**
	 * Get current entry
	 * @return Entry
	 */
	public function currentEntry()
	{
		$entry = $this->entries()->defaultSort()->first();

		if (!$entry)
		{
			$entry = new Entry;

			$entry->staff()->associate($this)->save();
		}

		return $entry;
	}

}

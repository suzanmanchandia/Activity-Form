<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;


/**
 * Comment
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $entry_id
 * @property string $content
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereEntryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Comment whereDeletedAt($value)
 * @property-read \User $user
 * @property-read \Entry $entry
 */
class Comment extends \Roski\Model {
	use SoftDeletingTrait;

	/**
	 * Comment creator
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Comment parent
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function entry()
	{
		return $this->belongsTo('Entry');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeDefaultSort($query)
	{
		return $query->with('user')->orderBy(static::CREATED_AT);
	}

	/**
	 * Formatted
	 * @return array
	 */
	public function toFormatted()
	{
		return [
			'name' => sprintf('%s %s', $this->user->first_name, $this->user->last_name),
			'date' => $this->created_at ? $this->created_at->format('F d, Y \a\t g:i A') : date('F d, Y \a\t g:i A'),
			'content' => nl2br($this->content)
		];
	}

}

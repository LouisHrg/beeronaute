<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Jun 2018 13:34:36 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Event
 * 
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $author
 * @property string $description
 * @property string $name
 * @property \Carbon\Carbon $startDate
 * @property \Carbon\Carbon $endDate
 * @property \Carbon\Carbon $published
 * @property int $slot
 * 
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $bars
 * @property \Illuminate\Database\Eloquent\Collection $posts
 *
 * @package App
 */
class Event extends Eloquent
{
	protected $casts = [
		'author' => 'int',
		'slot' => 'int'
	];

	protected $dates = [
		'startDate',
		'endDate',
		'published'
	];

	protected $fillable = [
		'author',
		'description',
		'name',
		'startDate',
		'endDate',
		'published',
		'slot'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'author');
	}

	public function bars()
	{
		return $this->belongsToMany(\App\Bar::class, 'events_bars')
					->withPivot('id')
					->withTimestamps();
	}

	public function posts()
	{
		return $this->hasMany(\App\Post::class, 'event');
	}
}

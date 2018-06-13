<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Jun 2018 18:57:28 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Event extends Eloquent implements HasMedia
{

use HasMediaTrait;

	protected $casts = [
		'author' => 'int',
		'slot' => 'int',
		'bar' => 'int'
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
		'slot',
		'bar'
	];



	public function user()
	{
		return $this->belongsTo(\App\User::class, 'author');
	}

	public function place()
	{
		return $this->belongsTo(\App\Bar::class, 'bar');
	}

	public function posts()
	{
		return $this->hasMany(\App\Post::class, 'event');
	}
		public function subscriptions()
	{
		return $this->hasMany(\App\Subscription::class, 'event');
	}
}

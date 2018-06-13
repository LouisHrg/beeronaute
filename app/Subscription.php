<?php

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

class Subscription extends Eloquent
{
	protected $casts = [
		'event' => 'int',
		'bar' => 'int',
		'type' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'event',
		'bar',
		'type',
		'user_id'
	];

	public function bar()
	{
		return $this->belongsTo(\App\Bar::class, 'bar');
	}

	public function event()
	{
		return $this->belongsTo(\App\Event::class, 'event');
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}
}

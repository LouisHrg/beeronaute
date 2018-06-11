<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 11 Jun 2018 15:03:23 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
	protected $casts = [
		'author' => 'int',
		'type' => 'int',
		'type_id' => 'int',
		'bar' => 'int',
		'event' => 'int',
		'publication' => 'int'
	];

	protected $fillable = [
		'author',
		'body',
		'type',
		'type_id',
		'bar',
		'event',
		'publication'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'author');
	}

	public function bar()
	{
		return $this->belongsTo(\App\Bar::class, 'bar');
	}

	public function event()
	{
		return $this->belongsTo(\App\Event::class, 'event');
	}

	public function publication()
	{
		return $this->belongsTo(\App\Publication::class, 'publication');
	}
}

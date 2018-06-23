<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 18 Jun 2018 12:11:18 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Notif extends Eloquent
{	

	use SoftDeletes, CascadeSoftDeletes;

	protected $casts = [
		'recipient' => 'int',
		'type' => 'int',
		'viewed' => 'int',
		'bar' => 'int',
		'event' => 'int'
	];

	protected $fillable = [
		'recipient',
		'type',
		'viewed',
		'bar',
		'event'
	];

	public function place()
	{
		return $this->belongsTo(\App\Bar::class, 'bar');
	}

	public function party()
	{
		return $this->belongsTo(\App\Event::class, 'event');
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'recipient');
	}
}

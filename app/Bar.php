<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
	protected $table = 'bars';
	public $timestamps = true;

	public function recommendations()
	{
		return $this->belongsToMany('App\Recommendation');
	}

	public function events()
	{
		return $this->belongsToMany('App\Event');
	}

}

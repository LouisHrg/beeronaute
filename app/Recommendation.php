<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Recommendation extends Model implements HasMedia
{

	use HasMediaTrait;
	use SoftDeletes; 
	use CascadeSoftDeletes;


	protected $table = 'recommendations';
	public $timestamps = true;

	public function bars()
	{
		return $this->belongsToMany(\App\Bar::class, 'recommendations_bars')
		->withPivot('id')
		->withTimestamps();
	}


}

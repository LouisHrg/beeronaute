<?php

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Eloquent implements HasMedia
{
	
	use HasMediaTrait;
	use SoftDeletes;

	protected $casts = [
		'author' => 'int'
	];

	protected $dates = [
		'published'
	];

	protected $fillable = [
		'title',
		'content',
		'published',
		'slug',
		'author'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'author');
	}
}

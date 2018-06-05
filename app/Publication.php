<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 05 Jun 2018 10:54:33 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Publication extends Eloquent implements HasMedia
{
use HasMediaTrait;

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

<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 14 Jun 2018 15:27:59 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mood
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $bars
 *
 * @package App
 */
class Mood extends Eloquent
{
	protected $fillable = [
		'name'
	];

	public function bars()
	{
		return $this->hasMany(\App\Bar::class, 'mood');
	}
}

<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 11 Jun 2018 15:26:15 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Place
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
class Place extends Eloquent
{
	protected $fillable = [
		'name'
	];

	public function bars()
	{
		return $this->hasMany(\App\Bar::class, 'place');
	}
}

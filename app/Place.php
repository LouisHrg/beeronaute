<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Jun 2018 17:58:58 +0000.
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
 * @package App
 */
class Place extends Eloquent
{
	protected $fillable = [
		'name'
	];
}

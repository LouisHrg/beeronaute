<?php

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;


class Place extends Eloquent
{
	protected $fillable = [
		'name'
	];

    public function bars()
    {
        return $this->belongsToMany(\App\Bar::class, 'id');
    }

}

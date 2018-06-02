<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendations';
    public $timestamps = true;

    public function bars()
    {
        return $this->belongsToMany('App\Bar');
    }

}

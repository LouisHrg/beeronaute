<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model 
{
    protected $table = 'subscriptions';
    public $timestamps = true;


        public function users()
    {
        return $this->belongsToMany('App\User');
    }
}

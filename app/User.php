<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;



class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';


    protected $dates = [
        'birthdate'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'bio',
        'birthdate',
        'firstname',
        'lastname',
        'email',
        'avatar',
        'password',
    ];



    public function bars()
    {
        return $this->hasOne(\App\Bar::class, 'manager');
    }

    public function comments()
    {
        return $this->hasMany(\App\Comment::class, 'author');
    }

    public function events()
    {
        return $this->hasMany(\App\Event::class, 'author');
    }

    public function posts()
    {
        return $this->hasMany(\App\Post::class, 'author');
    }

    public function publications()
    {
        return $this->hasMany(\App\Publication::class, 'author');
    }

    public function subscriptions()
    {
        return $this->hasMany(\App\Subscription::class);
    }

}

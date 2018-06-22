<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;


class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use HasMediaTrait;
    use SoftDeletes;
    use CascadeSoftDeletes;

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

    protected $cascadeDeletes = [
        'bars',
        'posts',
        'publications',
        'events',
        'subscriptions'
    ];

    

    public function bars()
    {
        return $this->hasOne(\App\Bar::class, 'manager');
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

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}

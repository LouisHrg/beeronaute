<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2|confirmed',
            'lastname' => 'required|string|max:100',
            'firstname' => 'required|string|max:100',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        


        $user = new User;
        
        $user->name = $data['name'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email =$data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->assignRole('user');

        $user->addMediaFromUrl('https://conferencecloud-assets.s3.amazonaws.com/default_avatar.png')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://www.parcanimalierdauvergne.fr/wp-content/uploads/2016/02/fichie_gibbon_mains_blanches.jpg')->toMediaCollection('banner-user');

        return $user;

    }
}

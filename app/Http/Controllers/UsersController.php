<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;



class UsersController extends Controller
{
	
	function saveUser(Request $request){
		
		$rolesId = implode(',',\Spatie\Permission\Models\Role::where('id' ,'>' ,0)->pluck('id')->toArray());

		$data = $request->validate([
			'name' => 'required|string|max:50|unique:users',
			'firstname' => 'required|string|max:100',
			'lastname' => 'required|string|max:100',
			'email' => 'required|string|email|max:255|unique:users',
			'role' => 'required|in:'.$rolesId,
			'password' => 'required|string|min:2|confirmed'

		]);

		$user = new User;

		$user->name = $data['name'];
		$user->firstname = $data['firstname'];
		$user->lastname = $data['lastname'];
		$user->email =$data['email'];
		$user->password = Hash::make($data['password']);

		$user->save();

		$user->assignRole(\Spatie\Permission\Models\Role::find($data['role']));


        $user->addMediaFromUrl('https://conferencecloud-assets.s3.amazonaws.com/default_avatar.png')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');

		return redirect()->route('admin-users-browse');
	}

	function updateUser(Request $request,$id){

		$rolesId = implode(',',\Spatie\Permission\Models\Role::where('id' ,'>' ,0)->pluck('id')->toArray());

		$user = User::find($id);

		$data = $request->validate([
			'name' => ['required','string','max:50',Rule::unique('users')->ignore($user->name,'name')],
			'firstname' => 'required|string|max:100',
			'lastname' => 'required|string|max:100',
			'email' => ['required','string','max:255','email',Rule::unique('users')->ignore($user->email,'email')],
			'role' => 'required|in:'.$rolesId,
			'password' => 'nullable|string|min:6|confirmed'

		]);

		$user->name = $data['name'];
		$user->firstname = $data['firstname'];
		$user->lastname = $data['lastname'];
		$user->email =$data['email'];

		if(isset($data->password)){
			$user->password = Hash::make($data['password']);
		}

		$user->save();

		$user->assignRole(\Spatie\Permission\Models\Role::find($data['role']));

		return redirect()->route('admin-users-browse');
	}

	function deleteUser(Request $request, $id){

		$user = User::find($id);

		if($user->id == \Auth::id()){
			return redirect()->route('admin-users-browse');
		}else{
			$user->delete();
		}


			return redirect()->route('admin-users-browse');

	}


	
}

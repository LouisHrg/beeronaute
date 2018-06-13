<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

		return redirect()->route('admin-users-browse');
	}

	
}

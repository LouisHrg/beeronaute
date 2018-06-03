<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class TestController extends Controller
{
	function test(){

/*		$role = Role::create(['name' => 'admin']);

		$user = Auth::user();

		$user->assignRole('admin');
*/
		echo "lol";
	}
}

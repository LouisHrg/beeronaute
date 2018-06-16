<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Event;
use App\Subscription;
use App\User;

use Carbon\Carbon;

class TestController extends Controller
{
	function test(){

		// Event::where('id','>',0)->delete();

		
		// 	$trigger = date('Y-m-d H:i:s',strtotime("-2 hours", time()));
		
		// // $events = Event::where('startDate','>',$trigger)->where('startDate','<',date('Y-m-d H:i:s'))->get();

		// $events = Event::all();


		// foreach ($events as $event) {
		// 	foreach($event->subscriptions as $sub){
		// 		dump($sub->user->email);
		// 	}
		// }
		
	}
}

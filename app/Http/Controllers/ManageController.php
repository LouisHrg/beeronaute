<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\User;
use App\Bar;
use Illuminate\Support\Facades\Hash;
use \Auth;

use Spatie\OpeningHours\OpeningHours;


class ManageController extends Controller
{
    function home(){

    	$bars = Bar::where('manager', Auth::id() )->get(); 

    	return view('manage.home',['bars'=>$bars]);
    }

	function publications(){

    	$bars = Bar::where('manager', Auth::id() )->get(); 

    	return view('manage.home',['bars'=>$bars]);
    }

    function newBar(){

    	$openingHours = OpeningHours::create([
    		'monday' => ['09:00-12:00', '13:00-18:00'],
    		'tuesday' => ['09:00-12:00', '13:00-18:00'],
    		'wednesday' => ['09:00-12:00'],
    		'thursday' => ['09:00-12:00', '13:00-18:00'],
    		'friday' => ['09:00-12:00', '13:00-20:00'],
    		'saturday' => ['09:00-12:00', '13:00-16:00']
		]);

    	$test = $openingHours->forDay('monday')[0]->format('H:i');
    	$test2 = $openingHours->forDay('monday')[1]->format('H:i');

    	dump($test);
    	dd($test2);

    	return view('manage.bars.create');
    
    }

}

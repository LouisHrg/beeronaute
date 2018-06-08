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

    	$h = OpeningHours::create([
    		'monday' => ['09:00-12:00', '13:00-18:00'],
    		'tuesday' => ['09:00-12:00', '13:00-18:00'],
    		'wednesday' => ['09:00-12:00','13:00-18:00'],
    		'thursday' => ['09:00-12:00','13:00-06:00'],
    		'friday' => ['09:00-12:00', '13:00-20:00'],
    		'saturday' => ['09:00-12:00', '13:00-16:00']
      ]);

        $schedule = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

        foreach ($schedule as $key) {

            $schedule[$key] = [];
            if(isset($h->forDay($key)[0])){
                array_push($schedule[$key], $h->forDay($key)[0]->format('H:i'));
                if(isset($h->forDay($key)[0])){
                    array_push($schedule[$key], $h->forDay($key)[1]->format('H:i'));
                }
            }
            if(empty($schedule[$key])){
                unset($schedule[$key]);
            }
        }

        $json = json_encode($schedule);


        return view('manage.bars.create');

    }

}

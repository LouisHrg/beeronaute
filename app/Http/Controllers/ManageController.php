<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Auth;

use App\Publication;
use App\User;
use App\Bar;

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

        $action = 'BarsController@saveBar';
        $method = 'POST';

        return view('bars.create',['action'=>$action,'method'=>$method]);

    }

    function Bars(){

        $bars = Bar::where('manager','=', Auth::id() )->get(); 

        $editAction = 'manage-publications-edit';
        $deleteAction = 'publications-edit';

        return view('bars.browse',['items'=>$bars,'editAction'=>$editAction,'deleteAction'=>$deleteAction]);
    }

    function editBar($id){

        $bar = Bar::find($id);

        if(Auth::id()!==$bar->user->id){
            abort(403, 'Access denied');
        }

        $action = ['BarsController@updateBar',$bar->id];
        $method = "POST";

        $schedule = array_values(json_decode($bar->schedule,true));
        array_unshift($schedule, null);
        unset($schedule[0]);

        return view('bars.edit',compact('bar','schedule', 'action', 'method'));

    }




}

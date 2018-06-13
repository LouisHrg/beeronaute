<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;

use App\Mail\EventSubscription;
use Illuminate\Support\Facades\Mail;

use App\Event;

class SubscriptionsController extends Controller
{	

    function attachEvent($id){

        $exist = Subscription::where('user_id','=',\Auth::id())
        ->where('event',"=",$id)->get();
        
        if($exist->isEmpty()){
            $sub = new Subscription;
            $sub->event = $id;
            $sub->user_id = \Auth::id();
            $sub->type = 1;

            $sub->save();
        }

        Mail::to(\Auth::user())->send(new EventSubscription(Event::find($id)));

        return redirect()->route('event-single',$id);

    }    
    function dettachEvent($id){

        $exist = Subscription::where('user_id','=',\Auth::id())->where('event',"=",$id)->get();

        if($exist->isNotEmpty()){

            $exist->each->delete();
        }


        return redirect()->route('event-single',$id);

    }
}

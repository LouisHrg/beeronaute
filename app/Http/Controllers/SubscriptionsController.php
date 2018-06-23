<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;

use App\Mail\EventSubscription;
use App\Mail\EventSubscriptionManager;
use App\Mail\EventUnsubscribe;

use Illuminate\Support\Facades\Mail;

use App\Event;
use App\User;
use App\Bar;

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

        $event = Event::find($id);

        Mail::to(\Auth::user())->send(new EventSubscription($event));

        Mail::to($event->place->user)->send(new EventSubscriptionManager($event, \Auth::user()));


        return redirect()->route('event-single',$id);

    }    
    function dettachEvent($id){

        $exist = Subscription::where('user_id','=',\Auth::id())->where('event',"=",$id)->get();

        if($exist->isNotEmpty()){

            $exist->each->delete();
            Mail::to($event->place->user)->send(new EventUnsubscribe($event, \Auth::user()));
            
        }

        return redirect()->route('event-single',$id);

    }


        function attachBar($id){

        $exist = Subscription::where('user_id','=',\Auth::id())
        ->where('bar',"=",$id)->get();
        
        if($exist->isEmpty()){
            $sub = new Subscription;
            $sub->bar = $id;
            $sub->user_id = \Auth::id();
            $sub->type = 2;

            $sub->save();
        }

        $bar = Bar::find($id);

        return redirect()->route('bar-single',$bar->slug);

    }    
    function dettachBar($id){

        $exist = Subscription::where('user_id','=',\Auth::id())->where('bar',"=",$id)->get();

        if($exist->isNotEmpty()){

            $exist->each->delete();
        }


        $bar = Bar::find($id);

        return redirect()->route('bar-single',$bar->slug);

    }
}

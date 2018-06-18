<?php

namespace App\Http\Middleware;

use Closure;

use App\Subscription;
use App\Event;
use App\Notif;

class PushNotifs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $subs = Subscription::where('user_id','=',\Auth::id())
        ->where('type','=','1')
        ->get();

        $nowMinusTwo = strtotime("-2 hours", time());
        $now = time();


        foreach($subs as $sub){

            $eventStart = strtotime($sub->party->startDate);
            $eventEnd = strtotime($sub->party->endDate);

            if($eventEnd < $now){
                continue;
            }

            if( $eventStart > $nowMinusTwo && $eventStart < $now){

                if( Notif::where('recipient',\Auth::id())->where('event',$sub->party->id)->where('type','=',1)->get()->isEmpty() ){
                    
                    $notif = new Notif;
                    $notif->viewed = 0;
                    $notif->type = 1;
                    $notif->event = $sub->party->id;
                    $notif->recipient = \Auth::id();
                    $notif->save();

                }

            }

            if($eventStart < $now && $eventEnd > $now){
                if(Notif::where('recipient',\Auth::id())->where('event',$sub->party->id)->where('type','=',2)->get()->isEmpty() ){

                    $notif = new Notif;
                    $notif->viewed = 0;
                    $notif->type = 2;
                    $notif->event = $sub->party->id;
                    $notif->recipient = \Auth::id();
                    $notif->save();

                }
            }

        }
        return $next($request);
    }
}

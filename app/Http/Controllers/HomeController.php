<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;
use App\Bar;
use App\Post;
use App\Event;
use App\Subscription;
use App\User;
use App\Notif;
use DB;

class HomeController extends Controller
{

    public function index()
    {   

        
        $posts = DB::table('subscriptions')
        ->select(DB::raw('MAX(posts.id) as id'))
        ->leftJoin('events','subscriptions.event','=','events.id')
        ->leftJoin('bars','subscriptions.bar','=','bars.id')
        ->leftjoin('posts', function($join){
                $join->on('posts.event','=','events.id');
                $join->orOn('posts.bar','=','bars.id');
        })
        ->where('subscriptions.user_id','=',\Auth::id())
        ->where('posts.id','!=','NULL')
        ->groupBy('posts.id')
        ->get();

        $ids = $posts->pluck('id')->toArray();

        $posts = Post::whereIn('id', $ids)->orderBy('created_at','DESC')->paginate(15);

        return view('home',compact('posts'));
    }

    public function news()
    {

        $posts = Publication::orderBy('published', 'desc')->paginate(10);

        return view('news',['posts'=>$posts]);
    }    

    public function singlePublication(Request $request, $slug){

        $post = Publication::where('slug',$slug)->firstOrFail();

        return view('single.publication', ['post'=>$post]);

    }
    public function bars()
    {

        $bars = Bar::where('status','=','1')->paginate(12);

        return view('bars',compact('bars'));
        
    }

    public function singleBar(Request $request, $slug){

        $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();
        $posts = Post::where('bar',$bar->id)->where('type',1)->get();
        $events = Event::where('bar',$bar->id)->latest()->limit(2)->get();
        

        return view('single.bar', compact('bar','posts','events'));

    }    

    public function allEvents(Request $request, $slug){

        $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();
        $events = Event::where('bar',$bar->id)->latest()->paginate(5);

        return view('single.barevents', compact('events','bar'));

    }

        public function allNotifs(Request $request){

        $notifs = Notif::where('recipient','=',\Auth::id())->orderBy('created_at','DESC')->paginate('15');

        return view('notifs',compact('notifs'));

    }

    public function barGallery(Request $request, $slug){



     $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();

     return view('single.bargallery', compact('bar'));

 }

 public function events(){

    $subs = Subscription::where('user_id','=',\Auth::id())->where('type','=','1')->paginate(10);

    $events = Event::where('endDate','>',date('Y-m-d H:i:s'))->orderBy('published', 'desc')->paginate(10);

    return view('events',compact('events','subs'));

}   
public function eventsMe(){

    $subs = Subscription::where('user_id','=',\Auth::id())->where('type','=','1')->paginate(10);

    return view('myevents',compact('subs'));

}

public function singleEvent(Request $request, $id){

    $event = Event::find($id);
    $posts = Post::where('event','=',$id)->where('type',2)->get();
    $exist = Subscription::where('user_id','=',\Auth::id())->where('event',"=",$id)->get()->isNotEmpty();
    return view('single.event', compact('event','exist','posts')  );

}    
public function profile($username){

    $user = User::where('name','=',$username)->firstOrFail();

    return view('single.profile', compact('user'));

}

public function myself(){

    $user = \Auth::user();
    
    return view('single.profile', compact('user'));
    
}
}

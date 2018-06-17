<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;
use App\Bar;
use App\Post;
use App\Event;
use App\Subscription;
use App\User;
use DB;

class HomeController extends Controller
{

    public function index()
    {   
        $posts = Post::paginate(15);

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

        return view('searchbars',compact('bars'));
        
    }

    public function singleBar(Request $request, $slug){

        $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();
        $posts = Post::where('bar',$bar->id)->get();
        $events = Event::where('bar',$bar->id)->latest()->limit(2)->get();
        

        return view('single.bar', compact('bar','posts','events'));

    }    

    public function allEvents(Request $request, $slug){

        $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();
        $events = Event::where('bar',$bar->id)->latest()->paginate(5);

        return view('single.barevents', compact('events','bar'));

    }

    public function barGallery(Request $request, $slug){



     $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();

     return view('single.bargallery', compact('bar'));

 }

 public function events(){

    $subs = Subscription::where('user_id','=',\Auth::id())->where('type','=','1')->paginate(10);

    $events = Event::orderBy('published', 'desc')->paginate(10);

    return view('events',compact('events','subs'));

}   
public function eventsMe(){

    $subs = Subscription::where('user_id','=',\Auth::id())->where('type','=','1')->paginate(10);

    return view('myevents',compact('subs'));

}

public function singleEvent(Request $request, $id){

    $event = Event::find($id);
    $posts = Post::where('event','=',$id)->get();
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

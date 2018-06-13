<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;
use App\Bar;
use App\Post;
use App\Event;
use App\Subscription;
use App\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

    	
        return view('home');
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
    public function singleBar(Request $request, $slug){

        $bar = Bar::where('slug',$slug)->where('status','=','1')->firstOrFail();
        $posts = Post::where('bar',$bar->id)->get();
        $events = Event::where('bar',$bar->id)->get();

        return view('single.bar', compact('bar','posts','events'));

    }

    public function events(){

        $events = Event::orderBy('published', 'desc')->paginate(10);

        return view('events',compact('events'));

    }

    public function singleEvent(Request $request, $id){

        $event = Event::find($id);
        $exist = Subscription::where('user_id','=',\Auth::id())->where('event',"=",$id)->get()->isNotEmpty();
        return view('single.event', compact('event','exist')  );

    }    
    public function profile($username){

        $user = User::where('name','=',$username)->firstOrFail();

        return view('single.profile', compact('user')  );


    }
}

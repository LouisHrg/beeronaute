<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Auth;

use App\Post;
use App\User;
use App\Bar;

use Spatie\OpeningHours\OpeningHours;


class ManageController extends Controller
{
    function home(){

    	$bars = Bar::where('manager', Auth::id() )->get(); 

    	return view('manage.home',['bars'=>$bars]);
    }

    function Bars(){

        $bars = Bar::where('manager','=', Auth::id() )->get(); 

        $editAction = 'manage-bars-edit';
        $deleteAction = 'publications-edit';

        return view('bars.browse',['items'=>$bars,'editAction'=>$editAction,'deleteAction'=>$deleteAction]);
    }

    function newBar(){

        $count = Bar::where('manager', '=', Auth::id())->count();

        if($count > 4){
            abort(403, 'Lol');
        }

        $action = 'BarsController@saveBar';
        $method = 'POST';

        return view('bars.create',['action'=>$action,'method'=>$method]);

    }

    function editBar($id){

        $bar = Bar::find($id);

        if(Auth::id()!==$bar->user->id){
            abort(403, 'Access denied');
        }

        $action = ['BarsController@updateBar',$bar->id];
        $method = "POST";


        $schedule = Bar::jsonToFormSchedule($bar->schedule);
        

        return view('bars.edit',compact('bar','schedule', 'action', 'method'));

    }


    function posts(Request $request){

        $search = $request->input('search');

        $items = Post::where([['author','=',\Auth::id()],['body', 'like', '%'.$search.'%']])
        ->orderBy('published', 'desc')
        ->paginate(15);

        return view('posts.browse',['page'=>'posts','items'=>$items->appends($request->except('page'))]);
    }

    function newPost(){

        $action = 'PostsController@savePost';
        $method = 'POST';

        return view('posts.create',['action'=>$action,'method'=>$method,'page'=>'posts']);

    }

    function events(Request $request){

        $search = $request->input('search');

        $items = Post::where([['author','=',\Auth::id()],['body', 'like', '%'.$search.'%']])
        ->orderBy('published', 'desc')
        ->paginate(15);

        return view('posts.browse',['page'=>'posts','items'=>$items->appends($request->except('page'))]);
    }

    function newEvent(){

        $action = 'EventsController@saveEventSingle';
        $method = 'POST';

        return view('events.create',['action'=>$action,'method'=>$method,'page'=>'events']);

    }

}
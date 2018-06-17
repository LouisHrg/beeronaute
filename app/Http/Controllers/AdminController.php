<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Publication;
use App\User;
use App\Event;
use App\Bar;

use DB;
use \Auth;

class AdminController extends Controller
{
    function home(){
    	return view('admin.home');
    }

    function publications(Request $request){

        $search = $request->input('search');

        $items = Publication::where('title', 'like', '%'.$search.'%')
        ->orWhere('content', 'like', '%' . $search . '%')
        ->orderBy('published', 'desc')
        ->paginate(15);

        return view('publications.browse',['items'=>$items->appends($request->except('page'))]);

    }
    
    function newPublication(){

      return view('publications.create');
  }

  function editPublication($id){

    $post = Publication::find($id);
    $action = ['PublicationsController@updatePublication',$post->id];
    $method = "POST";


    return view('publications.edit',compact('post', 'action', 'method'));
}


function users(Request $request){

    $search = $request->input('search');

    $items = User::where('email', 'like', '%'.$search.'%')
    ->orWhere('name', 'like', '%' . $search . '%')
    ->orWhere('firstname', 'like', '%' . $search . '%')
    ->orWhere('lastname', 'like', '%' . $search . '%')
    ->orWhere('email', 'like', '%' . $search . '%')
    ->paginate(15);

    return view('admin.users.browse',['items'=>$items->appends($request->except('page'))]);

}   

function newUser(){

  return view('admin.users.create');
}

function editUser($id){

    $user = User::find($id);

    return view('admin.users.edit',['user'=>$user]);
}


function events(Request $request){

    $search = $request->input('search');

    $items = Event::where([['events.name', 'like', '%'.$search.'%']])
    ->orderBy('published', 'desc')
    ->paginate(15);

    $editAction = 'admin-event-edit';
    $newAction = 'admin-event-create';

    return view('events.browse',
        ['page'=>'events',
        'items'=>$items->appends($request->except('page')),
        'editAction'=>$editAction,
        'newAction'=>$newAction
    ]);
}


function Bars(){

    $bars = Bar::paginate(15); 
    $editAction = 'admin-bars-edit';
    $newAction = 'admin-bars-create';
    $deleteAction = 'bar-delete';
    $editGalleryAction = 'admin-bars-edit-gallery';

    return view('bars.browse',['items'=>$bars,
        'newAction'=>$newAction,
        'editAction'=>$editAction,
        'deleteAction'=>$deleteAction,
        'editGalleryAction'=>$editGalleryAction]);
}

    function newBar(){

        $count = Bar::where('manager', '=', Auth::id())->count();


        $action = 'BarsController@saveBar';
        $method = 'POST';

        return view('bars.create',['action'=>$action,'method'=>$method]);

    }

    function editBar($id){

        $bar = Bar::find($id);

        $action = ['BarsController@updateBar',$bar->id];
        $method = "POST";


        $schedule = Bar::jsonToFormSchedule($bar->schedule);

        $page = 'bars';

        return view('bars.edit',compact('bar','schedule', 'action', 'method','page'));

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\User;
use Illuminate\Support\Facades\Hash;


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
    $action = route('admin-publications-edit',$post->id);
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

}

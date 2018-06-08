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

        return view('admin.publications.browse',['items'=>$items->appends($request->except('page'))]);


    }    
    function newPublication(){
      
      return view('admin.publications.create');
  }

  function editPublication($id){

    $post = Publication::find($id);
    $action = route('admin-publications-edit',$post->id);
    $method = "POST";

    return view('admin.publications.edit',compact('post', 'action', 'method'));
}
    function updatePublication(Request $request,$id){

        $publication = Publication::find($id)->firstOrFail();
        
        $data = $request->validate([
            'title' => 'required|max:255',
            'customcontent' => 'required',
            'slug' => 'required|max:120|unique:publications,slug,'.$publication->slug,
            'published' => 'date|required',
            'featured' => 'mimes:jpeg,png,jpg'
        ]);

         
        $publication->slug = $data['slug'];
        $publication->title = $data['title'];
        $publication->published = $data['published'];
        $publication->content =$data['customcontent'];
        $publication->author = \Auth::user()->id;

        $publication->save();

        $publication
        ->addMediaFromRequest('featured')
        ->withResponsiveImages()
        ->toMediaCollection('images');

        return redirect()->route('admin-publications-browse');

    }

    function savePublication(Request $request){

        $data = $request->validate([
            'title' => 'required|max:255',
            'customcontent' => 'required',
            'slug' => 'required|unique:publications|max:120',
            'published' => 'date|required',
            'featured' => 'mimes:jpeg,png,jpg'
        ]);

        $publication = new Publication;  
        $publication->title = $data['title'];
        $publication->slug = $data['slug'];
        $publication->published = $data['published'];
        $publication->content =$data['customcontent'];
        $publication->author = \Auth::user()->id;

        $publication->save();

        $publication
        ->addMediaFromRequest('featured')
        ->withResponsiveImages()
        ->toMediaCollection('images');

        return redirect()->route('admin-publications-browse');

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


    function saveUser(Request $request){
            
        $rolesId = implode(',',\Spatie\Permission\Models\Role::where('id' ,'>' ,0)->pluck('id')->toArray());

        $data = $request->validate([
            'name' => 'required|string|max:50|unique:users',
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:'.$rolesId,
            'password' => 'required|string|min:2|confirmed'

        ]);

        $user = new User;

        $user->name = $data['name'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email =$data['email'];
        $user->password = Hash::make($data['password']);

        $user->save();

        $user->assignRole(\Spatie\Permission\Models\Role::find($data['role']));

        return redirect()->route('admin-users-browse');
    }

  function editUser($id){

    $user = User::find($id);

    return view('admin.users.edit',['user'=>$user]);
}

}

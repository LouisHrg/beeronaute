<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;

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

}

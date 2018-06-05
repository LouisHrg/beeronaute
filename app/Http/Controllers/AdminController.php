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
                ->orWhere('content', 'like', '%' . $search . '%')->paginate(15);

    	return view('admin.publications.browse',['items'=>$items->appends($request->except('page'))]);
    }    
    function newPublication(){
		
		return view('admin.publications.create');
    }

    function savePublication(Request $request){

        $data = $request->validate([
            'title' => 'required|max:255',
            'customcontent' => 'required',
            'slug' => 'required|unique:publications|max:120',
            'published' => 'date|required'
        ]);


        $publication = new Publication;
        
        $publication->title = $data['title'];
        $publication->slug = $data['slug'];
        $publication->published = $data['published'];
        $publication->content =$data['customcontent'];
        $publication->author = \Auth::user()->id;

        $publication->save();

        return redirect()->route('admin-publications-browse');

        }
    
}

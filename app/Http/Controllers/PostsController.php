<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Bar;

class PostsController extends Controller
{
    function savePost(Request $request,$id){

        $bar = Bar::find($id);


        if($bar->manager == \Auth::id()){

    	$data = $request->validate([
    	'body' => 'string|required|between:20,500',
    	]);

    	$post = new Post;

    	$post->body = $data['body'];
    	$post->type = 1;
    	$post->bar = $id;
    	$post->author = \Auth::id();
    	
    	$post->save();

        }

        return redirect()->route('bar-single',$bar->slug);

    }
    
    function updatePost(Request $request){
    	dd($request);
    }
}

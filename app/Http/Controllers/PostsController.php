<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    function savePost(Request $request,$id){

    	$data = $request->validate([
    	'body' => 'string|required|between:20,500',
    	]);

    	$post = new Post;
    	$post->body = $data['body'];
    	$post->type = 1;
    	$post->bar = $id;
    	$post->author = \Auth::id();
    	
    	$post->save;

    	return redirect()->route('home');

    }
    
    function updatePost(Request $request){
    	dd($request);
    }
}

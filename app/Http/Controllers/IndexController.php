<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;

class IndexController extends Controller
{

	
    function index(){

    	$news = Publication::take(8)->orderBy('created_at','DESC')->get();

        return view('welcome',compact('news'));
    }

    function blog(){

    	$news = Publication::orderBy('published','DESC')->paginate(16);

    	return view('blog',compact('news'));
    }

    function singleArticle($slug){


    	$article = Publication::where('slug',$slug)->firstOrFail();



    	return view('article',compact('article'));
    }
}

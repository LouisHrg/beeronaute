<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;

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

        $posts = Publication::all();

        return view('news',['posts'=>$posts]);
    }

    public function singlePublication(Request $request, $slug){
        
        $post = Publication::where('slug',$slug)->first();

        return view('single.publication', ['post'=>$post]);

    }
}

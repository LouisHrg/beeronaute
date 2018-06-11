<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;
use App\Bar;
use App\Post;

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

        $posts = Publication::orderBy('published', 'desc')->paginate(10);

        return view('news',['posts'=>$posts]);
    }

    public function singlePublication(Request $request, $slug){
        
        $post = Publication::where('slug',$slug)->firstOrFail();

        return view('single.publication', ['post'=>$post]);

    }
    public function singleBar(Request $request, $slug){
        
        $bar = Bar::where('slug',$slug)->where('status','=','2')->firstOrFail();
        $posts = Post::where('bar',$bar->id)->get();

        return view('single.bar', ['bar'=>$bar,'posts'=>$posts]);

    }
}

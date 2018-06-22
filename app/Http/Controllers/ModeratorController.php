<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;
use App\Recommendation;

class ModeratorController extends Controller
{
  function home(){
   return view('moderator.home');
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

function publications(Request $request){

 $search = $request->input('search');

 $items = Publication::where('title', 'like', '%'.$search.'%')
 ->orWhere('content', 'like', '%' . $search . '%')
 ->orderBy('published', 'desc')
 ->paginate(15);

 $newAction = 'moderator-publications-create';
 $editAction = 'moderator-publications-edit';


 return view('publications.browse',
  [
    'items'=>$items->appends($request->except('page')),
    'newAction' => $newAction,
    'editAction' => $editAction

  ]);

}

function recommendations(Request $request){

 $search = $request->input('search');

 $items = Recommendation::where('title', 'like', '%'.$search.'%')
 ->orWhere('body', 'like', '%' . $search . '%')
 ->orderBy('published', 'desc')
 ->paginate(15);

 $newAction = 'moderator-reco-create';
 $editAction = 'moderator-publications-edit';


 return view('recommendations.browse',
  [
    'items'=>$items->appends($request->except('page')),
    'newAction' => $newAction,
    'editAction' => $editAction

  ]);
}

function newRecommendation(){
  return view('recommendations.create');
}

}

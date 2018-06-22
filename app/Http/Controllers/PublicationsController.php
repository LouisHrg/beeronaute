<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;

use App\Publication;
use App\User;

use Illuminate\Validation\Rule;


class PublicationsController extends Controller
{


	function savePublication(Request $request){

		$data = $request->validate([
			'title' => 'required|max:255',
			'customcontent' => 'required',
			'slug' => 'required|unique:publications|max:120',
			'published' => 'date_format:d/m/Y H:i|required',
			'featured' => 'mimes:jpeg,png,jpg'
		]);


		$publication = new Publication;  
		$publication->title = $data['title'];
		$publication->slug = $data['slug'];
		$publication->published =  date_create_from_format('d/m/Y H:i', $data['published']);
		$publication->content =$data['customcontent'];
		$publication->author = \Auth::user()->id;

		$publication->save();

		$publication
		->addMediaFromRequest('featured')
		->withResponsiveImages()
		->toMediaCollection('featured-publication');

		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}
		elseif(Auth::user()->hasRole('moderator')){
			return redirect()->route('moderator-publications-browse');
		}else{
			return redirect()->route('home');
		}
	}

	function updatePublication(Request $request,$id){
		

		$publication = Publication::find($id);
		
		$data = $request->validate([
			'title' => 'required|max:255',
			'customcontent' => 'required',
			'slug' => ['required','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/','max:150',Rule::unique('publications')->ignore($publication->slug,'slug')],
			'published' => 'date_format:d/m/Y H:i|required',
			'featured' => 'mimes:jpeg,png,jpg'
		]);

		$publication->slug = $data['slug'];
		$publication->title = $data['title'];
		$publication->published = $data['published'];
		$publication->content =$data['customcontent'];
		$publication->author = \Auth::user()->id;

		$publication->save();

		if(!empty($data['featured'])){
			$publication
			->addMediaFromRequest('featured')
			->withResponsiveImages()
			->toMediaCollection('featured-publication');
		}


		return redirect()->route('admin-publications-browse');

	}

	function deletePublication($id){

		$publication = Publication::find($id);

		if(!Auth::user()->hasRole('admin'))
		{
			if($publication->user->id == \Auth::id()){
				$publication->delete();
			}
		}else{
			$publication->delete();
		}

		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('moderator')){
			return redirect()->route('admin-publications-browse');
		}else{
			return redirect()->route('home');
		}

	}
}

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

	function updatePublication(Request $request,$id){

		$publication = Publication::find($id);
		
		$data = $request->validate([
			'title' => 'required|max:255',
			'customcontent' => 'required',
			'slug' => ['required','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/','max:150',Rule::unique('publications')->ignore($publication->slug,'slug')],
			'published' => 'date|required',
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
			->toMediaCollection('images');
		}


		return redirect()->route('admin-publications-browse');

	}
}

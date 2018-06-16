<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;
use App\Place;
use App\Bar;
use App\Medium;


use Spatie\OpeningHours\OpeningHours;
use App\Rules\Hourrange;

use Illuminate\Validation\Rule;

class BarsController extends Controller
{

	function saveBar(Request $request){

		
		$places = implode(',',\App\Place::where('id' ,'>' ,0)->pluck('id')->toArray());
		$moods = implode(',',\App\Place::where('id' ,'>' ,0)->pluck('id')->toArray());

		$data = $request->validate([

			'name' => 'required|max:255',
			'description' => 'string|required',
			'slug' => 'required|max:150|unique:bars|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
			'address' => 'string|required',
			'number' => 'required|regex:#^0[1-9][0-9]{8}$#',
			'email' => 'nullable|email',
			'image' => 'mimes:jpeg,png,jpg',
			'city' => 'required|in:'.$places,
			'mood' => 'required|in:'.$moods,
			'schedule1' => [new Hourrange],
			'schedule2' => [new Hourrange], 
			'schedule3' => [new Hourrange],
			'schedule4' => [new Hourrange],
			'schedule5' => [new Hourrange],
			'schedule6' => [new Hourrange],
			'schedule7' => [new Hourrange],
		]);


		$bar = new Bar;

		$bar->name = $data['name'];
		$bar->description = $data['description'];
		$bar->slug = $data['slug'];
		$bar->location =$data['address'];
		$bar->phone =$data['number'];
		$bar->email =$data['email'];
		$bar->place =$data['city'];
		$bar->status = 0;
		$bar->schedule =Bar::formToJsonSchedule($data);

		$bar->manager = \Auth::user()->id;

		$bar->save();

		if(!empty($data['image'])){
			$bar
			->addMediaFromRequest('image')
			->withResponsiveImages()
			->toMediaCollection('featured-bar');
		}


		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-bars');
		}else{
			return redirect()->route('home');

		}
	}

	function updateBar(Request $request, $id){

		$bar = Bar::find($id);

		$places = implode(',',\App\Place::where('id' ,'>' ,0)->pluck('id')->toArray());
		$moods = implode(',',\App\Place::where('id' ,'>' ,0)->pluck('id')->toArray());


		$data = $request->validate([
			'name' => 'required|max:255',
			'description' => 'string|required',
			'slug' => ['required','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/','max:150',Rule::unique('bars')->ignore($bar->slug,'slug')],
			'address' => 'string|required',
			'number' => 'required|regex:#^0[1-9][0-9]{8}$#',
			'email' => 'nullable|email',
			'image' => 'mimes:jpeg,png,jpg',
			'city' => 'required|in:'.$places,
			'mood' => 'required|in:'.$moods,
			'schedule1' => [new Hourrange],
			'schedule2' => [new Hourrange], 
			'schedule3' => [new Hourrange],
			'schedule4' => [new Hourrange],
			'schedule5' => [new Hourrange],
			'schedule6' => [new Hourrange],
			'schedule7' => [new Hourrange],
		]);

		$bar->name = $data['name'];
		$bar->description = $data['description'];
		$bar->slug = $data['slug'];
		$bar->location = $data['address'];
		$bar->phone = $data['number'];
		$bar->mood = $data['mood'];
		$bar->email = $data['email'];
		$bar->place = $data['city'];
		$bar->schedule =Bar::formToJsonSchedule($data);

		$bar->manager = \Auth::user()->id;

		$bar->save();

		if(!empty($data['image'])){
			$bar
			->addMediaFromRequest('image')
			->withResponsiveImages()
			->toMediaCollection('featured-bar');
		}


		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-bars');
		}else{
			return redirect()->route('home');
		}



	}

	function deleteBar(Request $request,$id){	

		$bar = Bar::find($id);

		if($bar->manager == \Auth::id()){
			$bar->delete();
		}

	}

	function saveFeatured(Request $request, $id){
		dd($id);
	}	

	function addToGallery(Request $request, $id){
		
		$bar = Bar::find($id);


		$data = $request->validate([
			'image' => 'mimes:jpeg,png,jpg',
		]);

		$bar->addMediaFromRequest('image')
		->withResponsiveImages()
		->toMediaCollection('gallery-bar');


		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-bars-edit-gallery',$id);
		}else{
			return redirect()->route('home');
		}


	}

	function deleteFromGallery(Request $request,$bar,$img){

		$barObj = Bar::find($bar);
		$imgObj = Medium::find($img);

		if($barObj->manager = \Auth::id()){

			$imgObj->delete();
		}


		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-bars-edit-gallery',$bar);
		}else{
			return redirect()->route('home');
		}

	}


}

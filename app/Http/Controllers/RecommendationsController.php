<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recommendation;

class RecommendationsController extends Controller
{
	function saveReco(Request $request){



		$places = implode(',',\App\Place::where('id' ,'>' ,0)->pluck('id')->toArray());

		$data = $request->validate([

			'title' => 'required|max:255',
			'body' => 'string|required',
			'slug' => 'required|max:150|unique:bars|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
			'published' => 'date_format:d/m/Y H:i|required',
			'bars' => 'required|array|min:1|exists:bars,id',
			'featured' => 'mimes:jpeg,png,jpg'
		]);

		$reco = new Recommendation;

		$reco->title = $data['title'];
		$reco->body = $data['body'];
		$reco->slug = $data['slug'];
		$reco->published = date_create_from_format('d/m/Y H:i', $data['published']);

		$reco->save();

		$reco->bars()->attach($data['bars']);

		if(!empty($data['featured'])){
			$reco
			->addMediaFromRequest('featured')
			->withResponsiveImages()
			->toMediaCollection('featured-reco');
		}


		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-bars');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-bars');
		}else{
			return redirect()->route('home');
		}
	}

}

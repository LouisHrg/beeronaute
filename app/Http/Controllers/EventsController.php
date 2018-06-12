<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function saveEventSingle(Request $request){
    	// dd($request);

		$bars = implode(',',\App\Bar::where('manager' ,'=' ,\Auth::id())->pluck('id')->toArray());

		$data = $request->validate([

			'title' => 'required|max:255',
			'customcontent' => 'required',
			'published' => 'date|required',
			'featured' => 'mimes:jpeg,png,jpg',
			'number' => 'required|integer',
			'bar' =>'required|in:'.$bars,
			'startat' => 'date|required',
			'endat' => 'date|required',

		]);
			if (strtotime($data['startat']) > strtotime($data['endat'])) {
				$validator->errors()->add('startat', 'Wrong dates !');
			}

		dd($data);

	}
}

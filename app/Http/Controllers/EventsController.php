<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Post;
use App\Bar;

use \Auth;

class EventsController extends Controller
{
	public function saveEventSingle(Request $request){

		$bars = implode(',',\App\Bar::where('manager' ,'=' ,\Auth::id())->pluck('id')->toArray());

		$data = $request->validate([

			'title' => 'required|max:255',
			'customcontent' => 'required',
			'featured' => 'present|mimes:jpeg,png,jpg',
			'number' => 'required|integer',
			'bar' =>'required|in:'.$bars,
			'published' => 'date_format:d/m/Y H:i|required',
			'startat' => 'date_format:d/m/Y H:i|required',
			'endat' => 'date_format:d/m/Y H:i|required',

		]);

		$event = new Event;
		$event->name =$data['title'];
		$event->description = $data['customcontent'];
		$event->startDate = date_create_from_format('d/m/Y H:i', $data['startat']);
		$event->endDate = date_create_from_format('d/m/Y H:i', $data['endat']);
		$event->published = date_create_from_format('d/m/Y H:i', $data['published']);
		$event->author = \Auth::id();
		$event->slot = $data['number'];
		$event->bar = $data['bar'];
		$event->canceled = 0;
		
		$event->save();

		$event
		->addMediaFromRequest('featured')
		->withResponsiveImages()
		->toMediaCollection('featured-event');



		$bar = Bar::find($event->place->id);


		if($bar->user->id == \Auth::id()){

			$post = new Post;

			$post->type = 3;
			$post->bar = $data['bar'];
			$post->event = $event->id;
			$post->author = \Auth::id();
			
			$post->save();

		}

		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-events');
		}else{
			return redirect()->route('home');
		}

	}

	public function editEvent(Request $request,$id){

		$event = Event::find($id);

		if($event->user->id != \Auth::id()){
			abort(403, 'Denied');
		}

		$bars = implode(',',\App\Bar::where('manager' ,'=' ,\Auth::id())->pluck('id')->toArray());

		$data = $request->validate([

			'title' => 'required|max:255',
			'customcontent' => 'required',
			'featured' => 'mimes:jpeg,png,jpg',
			'number' => 'required|integer',
			'bar' =>'required|in:'.$bars,
			'published' => 'date_format:d/m/Y H:i|required',
			'startat' => 'date_format:d/m/Y H:i|required',
			'endat' => 'date_format:d/m/Y H:i|required',

		]);

		$event->name =$data['title'];
		$event->description = $data['customcontent'];
		$event->startDate = date_create_from_format('d/m/Y H:i', $data['startat']);
		$event->endDate = date_create_from_format('d/m/Y H:i', $data['endat']);
		$event->published = date_create_from_format('d/m/Y H:i', $data['published']);
		$event->author = \Auth::id();
		$event->slot = $data['number'];
		$event->bar = $data['bar'];

		$event->save();

		if(!empty($data['featured'])){
			$event
			->clearMediaCollection('featured-event');
			$event
			->addMediaFromRequest('featured')
			->withResponsiveImages()
			->toMediaCollection('featured-event');
		}

		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-publications-browse');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-events');
		}else{
			return redirect()->route('home');
		}

	}

	function deleteEvent(Request $request,$id){	

		$event = Event::find($id);


		if(!Auth::user()->hasRole('admin'))
		{
			if($event->place->manager == \Auth::id()){
				$event->delete();
			}
		}else{
			$event->delete();
		}

		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-events');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-events');
		}else{
			return redirect()->route('home');
		}

	}

	function cancelEvent(Request $request,$id){

		$event = Event::find($id);

		if($event->place->manager == \Auth::id()){
			$event->canceled = 1;
			$event->save();
		}

		if(Auth::user()->hasRole('admin')){
			return redirect()->route('admin-events');
		}else if(Auth::user()->hasRole('manager')){
			return redirect()->route('manage-events');
		}else{
			return redirect()->route('home');
		}


	}
}

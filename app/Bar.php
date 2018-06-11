<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

use Spatie\OpeningHours\OpeningHours;

class Bar extends Model implements HasMedia
{

	use HasMediaTrait;

	protected $table = 'bars';
	public $timestamps = true;

	public function recommendations()
	{
		return $this->belongsToMany(\App\Recommendation::class, 'recommendations_bars')
		->withPivot('id')
		->withTimestamps();
	}

	public function events()
	{
		return $this->belongsToMany(\App\Event::class, 'events_bars')
		->withPivot('id')
		->withTimestamps();
	}
	
	public function user()
	{
		return $this->belongsTo(\App\User::class, 'manager');
	}

	public function place()
	{
		return $this->belongsTo(\App\Place::class, 'place');
	}

	public function posts()
	{
		return $this->hasMany(\App\Post::class, 'bar');
	}

	public function generateSchedule(){

		$h = OpeningHours::create([
			'monday' => ['09:00-12:00', '13:00-18:00'],
			'tuesday' => ['09:00-12:00', '13:00-18:00'],
			'wednesday' => ['09:00-12:00','13:00-18:00'],
			'thursday' => ['09:00-12:00','13:00-06:00'],
			'friday' => ['09:00-12:00', '13:00-20:00'],
			'saturday' => ['09:00-12:00', '13:00-16:00']
		]);

		$schedule = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

		foreach ($schedule as $key) {

			$schedule[$key] = [];
			if(isset($h->forDay($key)[0])){
				array_push($schedule[$key], $h->forDay($key)[0]->format('H:i'));
				if(isset($h->forDay($key)[0])){
					array_push($schedule[$key], $h->forDay($key)[1]->format('H:i'));
				}else{
					array_push($schedule[$key], "");
				}
			}
			if(empty($schedule[$key])){
				unset($schedule[$key]);
			}
		}

		$json = json_encode($schedule);
	}

	public static function formToJsonSchedule($data){
		
		if(isset($data['schedule1'])){
			$schedule['monday'] = $data['schedule1'];
		}
		if(isset($data['schedule2'])){
			$schedule['tuesday'] = $data['schedule2'];
		}
		if(isset($data['schedule3'])){
			$schedule['wednesday'] = $data['schedule3'];
		}
		if(isset($data['schedule4'])){
			$schedule['thursday'] = $data['schedule4'];
		}
		if(isset($data['schedule5'])){
			$schedule['friday'] = $data['schedule5'];
		}
		if(isset($data['schedule6'])){
			$schedule['saturday'] = $data['schedule6'];
		}
		if(isset($data['schedule7'])){
			$schedule['sunday'] = $data['schedule7'];
		}

		return json_encode($schedule);

	}

	public static function jsonToFormSchedule($data){
		

		$data = json_decode($data,true);
		$schedule = [];


		if(isset($data['monday'])){
			$schedule[1] = $data['monday'];
		}else{
			$schedule[1] = "";
		}
		if(isset($data['tuesday'])){
			$schedule[2] = $data['monday'];
		}else{
			$schedule[2] = "";
		}
		if(isset($data['wednesday'])){
			$schedule[3] = $data['monday'];
		}else{
			$schedule[3] = "";
		}
		if(isset($data['thursday'])){
			$schedule[4] = $data['monday'];
		}else{
			$schedule[4] = "";
		}
		if(isset($data['friday'])){
			$schedule[5] = $data['monday'];
		}else{
			$schedule[5] = "";
		}
		if(isset($data['saturday'])){
			$schedule[6] = $data['monday'];
		}else{
			$schedule[6] = "";
		}
		if(isset($data['sunday'])){
			$schedule[7] = $data['monday'];
		}else{
			$schedule[7] = "";
		}

		return $schedule;

	}

	public function jsonToObjSchedule(){
		$schedule = self::jsonToFormSchedule($this->schedule);




		if(isset($schedule[1])){
			$output['monday'] = [$schedule[1]];
		}
		if(isset($schedule[2])){
			$output['tuesday'] = [$schedule[2]];
		}
		if(isset($schedule[3])){
			$output['wednesday'] = [$schedule[3]];
		}
		if(isset($schedule[4])){
			$output['thursday'] = [$schedule[4]];
		}
		if(isset($schedule[5])){
			$output['friday'] = [$schedule[5]];
		}
		if(isset($schedule[6])){
			$output['saturday'] = [$schedule[6]];
		}
		if(isset($schedule[7])){
			$output['sunday'] = [$schedule[7]];
		}


		return OpeningHours::create($output);
		
	}


	public function printSchedule(){
		$schedule = self::jsonToFormSchedule($this->schedule);




		if(isset($schedule[1])){
			$output['monday'] = [$schedule[1]];
		}
		if(isset($schedule[2])){
			$output['tuesday'] = [$schedule[2]];
		}
		if(isset($schedule[3])){
			$output['wednesday'] = [$schedule[3]];
		}
		if(isset($schedule[4])){
			$output['thursday'] = [$schedule[4]];
		}
		if(isset($schedule[5])){
			$output['friday'] = [$schedule[5]];
		}
		if(isset($schedule[6])){
			$output['saturday'] = [$schedule[6]];
		}
		if(isset($schedule[7])){
			$output['sunday'] = [$schedule[7]];
		}


		dd($output);
		
	}

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
class Bar extends Model implements HasMedia
{

	use HasMediaTrait;

	protected $table = 'bars';
	public $timestamps = true;

	public function recommendations()
	{
		return $this->belongsToMany('App\Recommendation');
	}

	public function events()
	{
		return $this->belongsToMany('App\Event');
	}

		public function user()
	{
		return $this->hasOne('App\User','id');
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
}

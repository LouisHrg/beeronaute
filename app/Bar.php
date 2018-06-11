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

		protected $casts = [
		'manager' => 'int',
		'place' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'location',
		'phone',
		'email',
		'manager',
		'slug',
		'description',
		'place',
		'schedule',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'manager');
	}

	public function city()
	{
		return $this->belongsTo(\App\Place::class, 'place');
	}

	public function events()
	{
		return $this->belongsToMany(\App\Event::class, 'events_bars')
					->withPivot('id')
					->withTimestamps();
	}

	public function posts()
	{
		return $this->hasMany(\App\Post::class, 'bar');
	}

	public function recommendations()
	{
		return $this->belongsToMany(\App\Recommendation::class, 'recommendations_bars')
					->withPivot('id')
					->withTimestamps();
	}

	public function instantScheduleInfo(){


		return $this->jsonToObjSchedule()->isOpen();
		

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

		if(!empty($schedule[1])){
			$output['monday'] = [$schedule[1]];
		}
		if(!empty($schedule[2])){
			$output['tuesday'] = [$schedule[2]];
		}
		if(!empty($schedule[3])){
			$output['wednesday'] = [$schedule[3]];
		}
		if(!empty($schedule[4])){
			$output['thursday'] = [$schedule[4]];
		}
		if(!empty($schedule[5])){
			$output['friday'] = [$schedule[5]];
		}
		if(!empty($schedule[6])){
			$output['saturday'] = [$schedule[6]];
		}
		if(!empty($schedule[7])){
			$output['sunday'] = [$schedule[7]];
		}
		return OpeningHours::create($output);
		
	}


	public function printSchedule(){

		$schedule = self::jsonToFormSchedule($this->schedule);

		$output = "<ul class='schedule'>";

		if(!empty($schedule[1])){
			$output .= "<li>Lundi : ".$schedule[1]."</li>";
		}else{
			$output .= "<li>Lundi : Fermé</li>";
		}
		if(!empty($schedule[2])){
			$output .= "<li>Mardi : ".$schedule[2]."</li>";
		}else{
			$output .= "<li>Mardi : Fermé</li>";
		}
		if(!empty($schedule[3])){
			$output .= "<li>Mercredi : ".$schedule[3]."</li>";
		}else{
			$output .= "<li>Mercredi : Fermé</li>";
		}
		if(!empty($schedule[4])){
			$output .= "<li>Jeudi : ".$schedule[4]."</li>";
		}else{
			$output .= "<li>Jeudi : Fermé</li>";
		}
		if(!empty($schedule[5])){
			$output .= "<li>Vendredi : ".$schedule[5]."</li>";
		}else{
			$output .= "<li>Vendredi : Fermé</li>";
		}
		if(!empty($schedule[6])){
			$output .= "<li>Samedi : ".$schedule[6]."</li>";
		}else{
			$output .= "<li>Samedi : Fermé</li>";
		}
		if(!empty($schedule[7])){
			$output .= "<li>Dimanche : ".$schedule[7]."</li>";
		}else{
			$output .= "<li>Dimanche : Fermé</li>";
		}

		$output .= "</ul>";

		return $output;
		
	}

}

<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Bar;
use App\Event;
use App\User;

class FakeEvents extends Seeder
{

    public function run()
    {	
    	$faker = Faker::create();

    	foreach (range(1,150) as $index) {

           $bar = Bar::where('id','>',0)->inRandomOrder()->first();

           $name = $faker->words($nb = 3, $asText = true); 

           $event = new Event;

           $event->name = $name;
           $event->author = $bar->user->id;
           $event->slot = rand(5,100);
           $event->bar = $bar->id;
           $event->description = $faker->text($maxNbChars = 200);
           $event->published = date('Y-m-d H:i:s');
           $event->startDate = date('Y-m-d H:i:s',strtotime("+3 hours",time()));
           $event->endDate = date('Y-m-d H:i:s',strtotime("+13 hours",time()));

           $event->save();
           
           $event->addMediaFromUrl('https://source.unsplash.com/random')->toMediaCollection('featured-event');

       }
   }

}

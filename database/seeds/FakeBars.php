<?php

use Illuminate\Database\Seeder; 
use Faker\Factory as Faker;
use App\User;
use App\Bar;

class FakeBars extends Seeder
{

    public function run()
    {	
    	$faker = Faker::create();
        
    	$user = User::where('name','admin')->first();
    	foreach (range(1,150) as $index) {

    	$user = User::role('manager')->inRandomOrder()->first();

    	$slug = $faker->slug;

        DB::table('bars')->insert([
            'name' => $faker->company(),
            'location' => $faker->address,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'place' => rand(1,5),
            'manager' => $user->id,
            'mood' => rand(1,7),
            'price' => rand(1,5),
            'slug' => $slug,
            'description' => $faker->text($maxNbChars = 200),
            'schedule' => '{"monday":"17:00-02:00","tuesday":"17:00-02:00","wednesday":"17:00-02:00","thursday":"17:00-02:00","friday":"17:00-02:00","saturday":"17:00-02:00"}',
            'status' => 1,

        ]);

        $bar = Bar::where('slug', $slug)->first();
        $bar->addMediaFromUrl('https://source.unsplash.com/random')->toMediaCollection('featured-bar');


    	}

    }

}

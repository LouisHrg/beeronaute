<?php

use Illuminate\Database\Seeder; 
use Faker\Factory as Faker;
use App\User;

class FakePublications extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$faker = Faker::create();
        
    	$user = User::where('name','admin')->first();
    	foreach (range(1,50) as $index) {

        DB::table('publications')->insert([
            'content' => $faker->paragraphs(rand(1,10),true),
            'abstract' => $faker->text(200),
            'title' => $faker->words(3,true),
            'published' => $faker->dateTime,
            'slug' => $faker->slug,
            'author' => $user->id

        ]);

    	}

    }
}

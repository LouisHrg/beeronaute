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
            'content' => $faker->text,
            'title' => $faker->words($nb = 3, $asText = true),
            'published' => $faker->dateTime,
            'slug' => $faker->slug,
            'author' => $user->id

        ]);

    	}

    }
}

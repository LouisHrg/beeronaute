<?php

use Illuminate\Database\Seeder; 
use Faker\Factory as Faker;
use App\User;
use App\Publication;

class FakeNews extends Seeder
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
    	foreach (range(1,60) as $index) {
    	$slug = $faker->slug;
        DB::table('publications')->insert([
            'content' => $faker->paragraphs(rand(1,10),true),
            'abstract' => $faker->text(200),
            'title' => $faker->words(3,true),
            'published' => $faker->dateTime,
            'slug' => $slug,
            'author' => $user->id

        ]);

        $news = Publication::where('slug', $slug)->first();
        $news->addMediaFromUrl('https://source.unsplash.com/random')->toMediaCollection('featured-publication');

    	}

    }
}

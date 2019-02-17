<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class FakeManyUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('fr_FR');

        foreach (range(1,25) as $index) {

        $name = $faker->userName;

		DB::table('users')->insert([


    		'name' => $name,
    		'email' => $faker->safeEmail,
    		'firstname' => $faker->firstName,
    		'lastname' => $faker->lastName,
    		'bio' => $faker->text($maxNbChars = 200),
    		'password' => bcrypt('user'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

    	]);
        $user = User::where('name', $name)->first();
    	$user->assignRole('user');


        $user->addMediaFromUrl('http://fanfare-makabes.fr/wp-content/uploads/2015/09/user-image.jpg')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');


    	}

        foreach (range(1,25) as $index) {

        $name = $faker->userName;

        DB::table('users')->insert([


            'name' => $name,
            'email' => $faker->safeEmail,
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'bio' => $faker->text($maxNbChars = 200),
            'password' => bcrypt('user'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);
        $user = User::where('name', $name)->first();
        $user->assignRole('manager');


        $user->addMediaFromUrl('http://fanfare-makabes.fr/wp-content/uploads/2015/09/user-image.jpg')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');


        }
    }
}

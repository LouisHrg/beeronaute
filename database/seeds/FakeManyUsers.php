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
		
		$faker = Faker::create();
        
        foreach (range(1,50) as $index) {

        $name = $faker->userName;                

		DB::table('users')->insert([


    		'name' => $name,
    		'email' => $faker->safeEmail,
    		'firstname' => $faker->firstName,
    		'lastname' => $faker->lastName,
    		'bio' => $faker->text($maxNbChars = 200),
    		'password' => bcrypt('user'),

    	]);
        $user = User::where('name', $name)->first();
    	$user->assignRole('user');

    	}

        foreach (range(1,50) as $index) {

        $name = $faker->userName;                

        DB::table('users')->insert([


            'name' => $name,
            'email' => $faker->safeEmail,
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'bio' => $faker->text($maxNbChars = 200),
            'password' => bcrypt('user'),

        ]);
        $user = User::where('name', $name)->first();
        $user->assignRole('manager');

        }
    }
}

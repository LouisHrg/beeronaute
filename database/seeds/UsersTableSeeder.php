<?php

use Illuminate\Database\Seeder;
use App\User;

use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

    	DB::table('users')->insert([
    		'name' => 'admin',
    		'email' => 'admin@gmail.com',
            'bio' => $faker->text($maxNbChars = 200),
    		'password' => bcrypt('admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

    	]);

    	$user = User::where('name', 'admin')->first();
    	$user->assignRole('admin');

        $user->addMediaFromUrl('http://fanfare-makabes.fr/wp-content/uploads/2015/09/user-image.jpg')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');


        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'bio' => $faker->text($maxNbChars = 200),
            'password' => bcrypt('manager'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);

        $user = User::where('name', 'manager')->first();
        $user->assignRole('manager');

        $user->addMediaFromUrl('http://fanfare-makabes.fr/wp-content/uploads/2015/09/user-image.jpg')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');


        DB::table('users')->insert([
            'name' => 'user',
            'bio' => $faker->text($maxNbChars = 200),
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);

        $user = User::where('name', 'user')->first();
        $user->assignRole('user');

        $user->addMediaFromUrl('http://fanfare-makabes.fr/wp-content/uploads/2015/09/user-image.jpg')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');



        DB::table('users')->insert([
            'name' => 'moderator',
            'bio' => $faker->text($maxNbChars = 200),
            'email' => 'moderator@gmail.com',
            'password' => bcrypt('moderator'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);

        $user = User::where('name', 'moderator')->first();
        $user->assignRole('moderator');

        $user->addMediaFromUrl('http://fanfare-makabes.fr/wp-content/uploads/2015/09/user-image.jpg')->toMediaCollection('avatar-user');
        $user->addMediaFromUrl('https://source.unsplash.com/random/')->toMediaCollection('banner-user');


    }
}

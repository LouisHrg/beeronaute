<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    		'name' => 'admin',
    		'email' => 'admin@gmail.com',
    		'password' => bcrypt('admin'),

    	]);
    	
    	$user = User::where('name', 'admin')->first();
    	$user->assignRole('admin');

        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager'),

        ]);
        
        $user = User::where('name', 'manager')->first();
        $user->assignRole('manager');

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),

        ]);
        
        $user = User::where('name', 'user')->first();
        $user->assignRole('user');


        DB::table('users')->insert([
            'name' => 'moderator',
            'email' => 'moderator@gmail.com',
            'password' => bcrypt('moderator'),

        ]);
        
        $user = User::where('name', 'moderator')->first();
        $user->assignRole('moderator');

    }
}

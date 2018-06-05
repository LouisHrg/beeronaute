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

    }
}

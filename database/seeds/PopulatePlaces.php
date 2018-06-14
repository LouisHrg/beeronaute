<?php

use Illuminate\Database\Seeder;

use App\Place;

class PopulatePlaces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('places')->insert(['name' => 'Paris']);
		DB::table('places')->insert(['name' => 'Toulouse']);
		DB::table('places')->insert(['name' => 'Marseille']);
		DB::table('places')->insert(['name' => 'Lille']);
		DB::table('places')->insert(['name' => 'Brest']);

    }
}

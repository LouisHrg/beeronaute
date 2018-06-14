<?php

use Illuminate\Database\Seeder;

use app\Mood;

class PopulateMoods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('moods')->insert(['name' => 'Rock']);
    	DB::table('moods')->insert(['name' => 'Chic']);
    	DB::table('moods')->insert(['name' => 'Hipster']);
    	DB::table('moods')->insert(['name' => "Avec l'argent des français"]);
    	DB::table('moods')->insert(['name' => 'Prolotaire']);
    	DB::table('moods')->insert(['name' => 'Etudiant']);
    	DB::table('moods')->insert(['name' => 'Lounge']);

    }
}

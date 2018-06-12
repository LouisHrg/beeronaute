<?php

use Illuminate\Database\Seeder;

class seedme extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	feed_places::class,
        	RolesAndPermissionsSeeder::class,
        	UsersTableSeeder::class,
        	FakePublications::class
        ]);
    }
}

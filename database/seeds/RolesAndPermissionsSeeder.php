<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()['cache']->forget('spatie.permission.cache');


        $role = Role::create(['name' => 'user']);

        $role = Role::create(['name' => 'manager']);

        $role = Role::create(['name' => 'moderator']);

        $role = Role::create(['name' => 'admin']);

    }
}

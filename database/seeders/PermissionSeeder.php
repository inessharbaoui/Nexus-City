<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'city_planner']);
        Permission::create(['name' => 'view traffic data']);
    }
}

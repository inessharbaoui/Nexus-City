<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function createRoleAndPermission()
    {
        if (!Role::where('name', 'city_planner')->exists()) {
            Role::create(['name' => 'city_planner']);

            return 'City planner role created successfully.';
        }

        if (!Permission::where('name', 'view traffic data')->exists()) {
            Permission::create(['name' => 'view traffic data']);
        }

        return 'City planner role already exists.';
    }
}

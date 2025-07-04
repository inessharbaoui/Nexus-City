<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function assignRoleToUser()
    {
        $user = User::find(1);

        if ($user) {
            $user->assignRole('city_planner');

            return response()->json(['message' => 'Role assigned successfully'], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}

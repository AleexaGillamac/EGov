<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with("permissions")->get();
        $permissions = Permission::all();

        return response()->json([
            'roles' => $roles,
            'permission' => $permissions
        ]);
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        $permissions = Permissions::all();

        return response()->json([
            'roles' => $roles,
            'permission' => $permissions,
        ]);
    }

    public function update() 
    {
        
    }
}

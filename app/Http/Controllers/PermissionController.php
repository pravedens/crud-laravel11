<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('admin.authorize.permissions.indexPermissions', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|min:3'
        ]);

        $permission = Permission::create([
            'name' => $request->permission,
            'guard_name' => 'web'
        ]);

        $permission->syncRoles($request->roles);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfull');
    }
}

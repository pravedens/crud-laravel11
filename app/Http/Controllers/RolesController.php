<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.authorize.roles.indexRoles', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roles' => 'required|min:3'
        ]);

        Role::create([
            'name' => $request->roles,
            'guard_name' => 'web'
        ]);

        return redirect()->route('roles.index')->with('success', 'Roles Saved!');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.authorize.roles.editRoles', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->role
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Roles Updated!');
    }

    public function destroy(String $id)
    {
        $role = Role::find($id);

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Roles Deleted!');
    }
}

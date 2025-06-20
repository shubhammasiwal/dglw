<?php

namespace App\Http\Controllers\Role;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        try {
            $roles = Role::orderByDesc('created_at')->get();
            $roles->transform(function ($item) {
                $item->role_label = config('constants.ROLES_LABEL')[strtoupper($item->name)] ?? $item->name;
                return $item;
            });
            return view('pages.Role.index', compact('roles'));
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function assignPermissions($id) {
        try {
            $role = Role::findOrFail($id);
            $role->role_label = config('constants.ROLES_LABEL')[strtoupper($role->name)] ?? $role->name;
            $permissions = Permission::all();
            return view('pages.Role.assign_permissions', compact(['role', 'permissions']));
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function storeRolePermissions(Request $request) {
        try {
            $role = Role::findOrFail($request->role_id);
            $role->permissions()->sync($request->permissions);
            return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}

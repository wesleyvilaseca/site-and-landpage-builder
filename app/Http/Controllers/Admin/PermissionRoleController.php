<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    public function index($role_id)
    {
        $role = Role::find($role_id);
        if (!$role_id) return redirect()->back();

        $data['permissions'] = Permission::all();
        $data['permissions_role'] = PermissionRole::where('role_id', $role->id)->get();
        $data['title'] = 'Permissions role ' . $role->name;
        $data['toptitle'] = 'Permissions role ' . $role->name;
        $data['action'] = route('role.permissions.sync', $role->id);

        return view('admin.permissions_roles.index', $data);
    }

    public function sync($id, Request $request)
    {
        $role = Role::find($id);
        if (!$role) return redirect()->back();

        if ($request->permission) {
            PermissionRole::where('role_id', $role->id)->delete();

            $data = [];
            foreach ($request->permission as $permission) {
                $data[] = ['permission_id' => $permission, 'role_id' => $role->id];
            }

            $result = PermissionRole::insert($data);
            if (!$result) {
                return redirect()->route('roles')->with('error', 'error on operation');
            }
        }

        return redirect()->route('roles')->with('success', 'Success on operation');
    }
}

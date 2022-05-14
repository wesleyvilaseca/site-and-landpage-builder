<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //

    public function index()
    {
        $data['title']      = 'Roles';
        $data['toptitle']   = 'Roles';
        $data['list']       = Role::all();
        $data['roles']      = true;
        $data['perm']      = true;

        return view('admin.roles.index', $data);
    }

    public function create()
    {
        $data['title']      = 'New Post';
        $data['toptitle']   = 'New Post';
        $data['roles']      = true;
        $data['action']     = route('role.save');

        return view('admin.roles.create', $data);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->back();
        }

        $data['title']      = 'Edit role ' . $role->title;
        $data['toptitle']   = 'Edit role ' . $role->title;
        $data['roles']      = true;
        $data['role']       = $role;
        $data['action']     = route('role.update', $role->id);

        return view('admin.roles.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'         => ['required'],
            'label'   => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = Role::create([
            'name' => $request->name,
            'label' => $request->label
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('roles')->with('success', 'success on create role');
    }

    public function update($id, Request $request)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->back();
        }

        $validate = Validator::make($request->all(), [
            'name'         => ['required'],
            'label'   => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = Role::where('id', $id)->update([
            'name'         => $request->name,
            'label'   => $request->label
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('roles')->with('success', 'success on edit role');
    }

    public function delete($id)
    {
        $post = Role::find($id);
        if (!$post) {
            return redirect()->back();
        }

        $result = Role::where('id', $id)->delete();

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('roles')->with('success', 'success on delete role');
    }
}

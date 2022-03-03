<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
      //

      public function index()
      {
          $data['title']      = 'Roles';
          $data['toptitle']   = 'Roles';
          $data['list']       = Permission::all();
          $data['action']     = route('permission.new');
          $data['permissions']      = true;
  
          return view('admin.permissions.index', $data);
      }
  
      public function create()
      {
          $data['title']      = 'New permission';
          $data['toptitle']   = 'New permission';
          $data['permissions']      = true;
          $data['action']     = route('permission.save');
  
          return view('admin.permissions.create', $data);
      }
  
      public function edit($id)
      {
          $permission = Permission::find($id);
          if (!$permission) {
              return redirect()->back();
          }
  
          $data['title']      = 'Edit permission ' . $permission->title;
          $data['toptitle']   = 'Edit permission ' . $permission->title;
          $data['permissions']      = true;
          $data['permission']       = $permission;
          $data['action']     = route('permission.update', $permission->id);
  
          return view('admin.permissions.create', $data);
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
  
          $result = Permission::create([
              'name' => $request->name,
              'label' => $request->label
          ]);
  
          if (!$result) {
              return redirect()->back()->with('warning', 'error on execution operation');
          }
  
          return redirect()->route('permissions')->with('success', 'success on create role');
      }
  
      public function update($id, Request $request)
      {
          $permission = Permission::find($id);
          if (!$permission) {
              return redirect()->back();
          }
  
          $validate = Validator::make($request->all(), [
              'name'         => ['required'],
              'label'   => ['required'],
          ]);
  
          if ($validate->fails()) {
              return redirect()->back()->with('errors', $validate->errors());
          }
  
          $result = Permission::where('id', $id)->update([
              'name'         => $request->name,
              'label'   => $request->label
          ]);
  
          if (!$result) {
              return redirect()->back()->with('warning', 'error on execution operation');
          }
  
          return redirect()->route('permissions')->with('success', 'success on edit role');
      }
  
      public function delete($id)
      {
          $post = Permission::find($id);
          if (!$post) {
              return redirect()->back();
          }
  
          $result = Permission::where('id', $id)->delete();
  
          if (!$result) {
              return redirect()->back()->with('warning', 'error on execution operation');
          }
  
          return redirect()->route('permissions')->with('success', 'success on delete role');
      }
}

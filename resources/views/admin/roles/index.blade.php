@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <a href="{{ route('role.new') }}" class="btn btn-primary btn-sm">ADD</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($list as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('role.permissions', $role->id) }}" class="btn btn-sm btn-info">Permissions</a>
                    <a href="{{ route('role.remove', $role->id) }}" class="btn btn-sm btn-danger">Remove</a>
                </td>
              </tr>
            @empty
                nothing to list
            @endforelse
        </tbody>
      </table>
</div>
@stop
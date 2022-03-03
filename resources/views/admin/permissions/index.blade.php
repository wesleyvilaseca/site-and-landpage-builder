@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <a href="{{ $action }}" class="btn btn-primary btn-sm">ADD</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($list as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('permission.remove', $permission->id) }}" class="btn btn-sm btn-danger">Remove</a>
                </td>
              </tr>
            @empty
                nothing to list
            @endforelse
        </tbody>
      </table>
</div>
@stop
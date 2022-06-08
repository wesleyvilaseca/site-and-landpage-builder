@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('anotation_create')
            <a href="{{ route('anotation.new') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Anotation</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $anotation)
                    <tr>
                        <td>{{ $anotation->title }}</td>
                        <td>
                            @can('anotation_edit', $anotation)
                                <a href="{{ route('anotation.edit', $anotation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            @can('anotation_delete', $anotation)
                                <a href="{{ route('anotation.remove', $anotation->id) }}"
                                    class="btn btn-sm btn-danger">Remove</a>
                            @endcan

                        </td>
                    </tr>
                @empty
                    nothing to list
                @endforelse
            </tbody>
        </table>
    </div>
@stop
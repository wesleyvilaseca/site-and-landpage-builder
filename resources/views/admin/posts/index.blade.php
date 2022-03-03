@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('create_post', $list[0])
            <a href="{{ route('post.new') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            @can('edit_post', $post)
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            @can('delete_post', $post)
                                <a href="{{ route('post.remove', $post->id) }}" class="btn btn-sm btn-danger">Remove</a>
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

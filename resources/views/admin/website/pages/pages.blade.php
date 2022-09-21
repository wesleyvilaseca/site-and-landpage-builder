@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('page_create')
            <a href="{{ route('pages.create', $website->id) }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table" id="customers-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $page)
                    <tr>
                        <td>{{ $page->name }}
                            @if ($page->homepage == 1)
                                <i class="fas fa-star" style="color: #FFD700"></i>
                            @endif
                        </td>
                        <td>
                            @can('page.edit', $page)
                                <a href="{{ route('pages.edit', [$website->id, $page->id]) }}"
                                    class="btn btn-sm btn-info">Editar</a>
                            @endcan

                            @can('page.editlayout', $page)
                                <a href="{{ route('pagebuilder.build', $page->id) }}?site_id={{ $website->id }}"
                                    class="btn btn-sm btn-warning">Editar layout</a>
                            @endcan

                            @can('page.delete', $page)
                                <a href="{{ route('pages.delete', [$website->id, $page->id]) }}" onclick="return deleteSite('{{$page->name}}');" class="btn btn-sm btn-danger">Remove</a>
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

@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            $('#customers-table').DataTable();
        });

        function deleteSite(title) {
                if (!confirm(`Tem certeza que deseja remover a página ${title}?`))
                    event.preventDefault();
            }
    </script>
@stop

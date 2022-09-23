@extends('settings-website.layout.theme')
@section('content')
    <div class="container-fluid">
        @can('page_create')
            <a href="#" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table" id="customers-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Editar</a>
                            @can('page.editlayout', $page)
                                <a href="#"
                                    class="btn btn-sm btn-warning">Editar</a>
                            @endcan

                            @can('page.delete', $page)
                                <a href="#"
                                    onclick="return deleteSite('{{ $page->name }}');" class="btn btn-sm btn-danger">Remove</a>
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

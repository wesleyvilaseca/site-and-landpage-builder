@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('website_create')
            <a href="{{ route('websites.create') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table" id="customers-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Url</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $website)
                    <tr>
                        <td>{{ $website->title }}</td>
                        <td>{{ $website->site_url }}</td>
                        <td>
                            @switch(@$website->status)
                                @case(0)
                                    <span class="badge badge-secondary">Inativo</span>
                                @break

                                @case(1)
                                    <span class="badge badge-warning">Em manutenção</span>
                                @break

                                @case(2)
                                    <span class="badge badge-primary">Ativo</span>
                                @break

                                <span class="badge badge-primary">any</span>

                                @default
                            @endswitch
                        </td>
                        <td>
                            @can('website.edit', $website)
                                <a href="{{ route('websites.edit', $website->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            @can('website.delete', $website)
                                <a href="{{ route('websites.delete', $website->id) }}" onclick="return deleteSite('{{$website->title}}');" class="btn
                                    btn-sm btn-danger">Remove</a>
                            @endcan

                            @can('website.pages', $website)
                                <a href="{{ route('pages', $website->id) }}" class="btn btn-sm btn-primary">Pages</a>
                            @endcan

                            <a href="{{ $website->site_url }}" class="btn btn-sm btn-success" target="_blanck"><i class="fas fa-eye"></i> Visualizar</a>

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
                if (!confirm(`Tem certeza que deseja remover o website ${title}?`))
                    event.preventDefault();
            }
        </script>
    @stop

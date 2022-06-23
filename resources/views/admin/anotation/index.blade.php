@inject('Cripto', 'App\Supports\support_cripto\CriptoForBlade')

@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('anotation_create')
            <a href="{{ route('anotation.new') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table" id="anotation-table">
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

                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#modal{{ $anotation->id }}">
                                visualizar anotação
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $anotation->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $anotation->title }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="15" id="anotation" name="anotation" readonly> {{ is_base64($anotation->anotation) ? $Cripto::decrypt($anotation->anotation) : $anotation->anotation }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @can('anotation_edit', $anotation)
                                <a href="{{ route('anotation.edit', $anotation->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
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

@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            $('#anotation-table').DataTable();
        });
    </script>
@stop

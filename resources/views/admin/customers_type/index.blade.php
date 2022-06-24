@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('customers_type_create')
            <a href="{{ route('customers_type.new') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table" id="customers-type-table">
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $customer_type)
                    <tr>
                        <td>{{ $customer_type->title }}</td>
                        <td>
                            @can('customers_type.edit', $customer_type)
                                <a href="{{ route('customers_type.edit', $customer_type->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            @can('customers_type.delete', $customer_type)
                                <a href="{{ route('customers_type.remove', $customer_type->id) }}"
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
            $('#customers-type-table').DataTable();
        });
    </script>
@stop

@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('customers_create')
            <a href="{{ route('customers.new') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table" id="customers-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->customer_type->title }}</td>
                        <td>
                            @can('customers.edit', $customer)
                                <a href="{{ route('customers.edit', $customer->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            @can('customers.delete', $customer)
                                <a href="{{ route('customers.remove', $customer->id) }}"
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
            $('#customers-table').DataTable();
        });
    </script>
@stop

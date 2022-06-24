@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form action="{{ $action }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name of customer customer"
                    value="{{ @$customer ? $customer->name : @old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname"
                    placeholder="lastname of customer customer"
                    value="{{ @$customer ? $customer->lastname : @old('lastname') }}" required>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Selecione o tipo de cliente</label>
                <select class="form-control" id="exampleFormControlSelect1" name="customer_type_id" required>
                    <option disabled selected>Select an option</option>
                    @foreach ($customers_types as $type)
                        <option value="{{ $type->id }}"
                            {{ @$customer and ($customer->customer_type_id == $type->id ? 'selected' : '') }}>
                            {{ $type->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="email of customer customer" value="{{ @$customer ? $customer->email : @old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    placeholder="phone of customer customer" value="{{ @$customer ? $customer->phone : @old('phone') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="password of customer customer" value="" required>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Selecione o status</label>
                <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                    <option value="1" {{ @$customer and ($customer->status == 1 ? 'selected' : '') }}> Ativo </option>
                    <option value="0" {{ @$customer and ($customer->status == 1 ? 'selected' : '') }}> Inativo </option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@stop

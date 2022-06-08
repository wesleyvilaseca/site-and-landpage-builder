@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form action="{{ $action }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title of anotation"
                    value="{{ @$anotation ? $anotation->title : '' }}" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Anotação</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="anotation" name="anotation">{{ @$anotation->anotation }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

        </form>
    </div>
@stop

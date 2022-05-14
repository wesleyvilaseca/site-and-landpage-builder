@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form action="{{ $action }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title of my qrcode"
                    value="{{ @$qrcode ? $qrcode->title : '' }}" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Url</label>
                <input type="url" class="form-control" id="url" name="url" placeholder="https://myurl.com"
                    value="{{ @$qrcode ? $qrcode->url : '' }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

        </form>
    </div>
@stop

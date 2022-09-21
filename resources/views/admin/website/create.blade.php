@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <form action="{{ $action }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titulo do site</label>
                <input type="text" class="form-control form-control-sm" id="title" name="title"
                    value="{{ @$website ? $website->title : '' }}">
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">Url do site</label>
                <input type="url" class="form-control form-control-sm" id="site_url" name="site_url"
                    value="{{ @$website ? $website->site_url : '' }}">
            </div>

            <div class="form-group">
                <label for="status">Status do site</label>
                <select class="form-control form-control-sm" id="status" name="status" required>
                    <option disabled selected>Selecione uma opção</option>
                    <option value="0" {{ !@$website ? '' : $website->status == '0' ? 'selected' : '' }}>Inativo</option>
                    <option value="1" {{ !@$website ? '' : $website->status == '1' ? 'selected' : '' }}>Em manutenção</option>
                    <option value="2" {{ !@$website ? '' : $website->status == '2' ? 'selected' : '' }}>Ativo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Https</label>
                <select class="form-control form-control-sm" id="https" name="https" required>
                    <option disabled selected>Selecione uma opção</option>
                    <option value="0" {{ !@$website ? '' : $website->https == '0' ? 'selected' : '' }}>Inativo</option>
                    <option value="1" {{ !@$website ? '' : $website->https == '1' ? 'selected' : '' }}>Ativo</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </div>
        </form>
    </div>
@stop

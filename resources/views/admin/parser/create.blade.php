@extends('layouts.admin')
@section('content') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить ссылки источников</h1>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <form method="POST" action="{{ route('admin.parser.store') }}">
        @csrf
        <p style="color: rgba(0, 0, 0, 0.308)">Добавьте ссылки через запятую</p>
        <div class="form-group">
            <label for="link_list"></label>
            <textarea name="link_list" id="link_list" class="form-control @error('link_list') is-invalid @enderror">{{ old('link_list') }}</textarea>
        </div>
        <br/>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
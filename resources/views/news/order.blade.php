@extends('layouts.news')
@section('content') 


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Запрос</h1>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <form method="POST" action="{{ route('mainorder.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"/>
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона</label>
                <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"/>
            </div>
            <div class="form-group">
                <label for="description">Описание запроса</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <br/>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection
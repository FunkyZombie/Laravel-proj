@extends('layouts.admin')
@section('content') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить новость</h1>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Категории</label>
            <select class="form-select @error('categories') is-invalid @enderror" multiple name="categories[]" id="categories" >
                @foreach ($categories as $item)
                    <option @if(in_array($item->id, old('categories') ?? [])) selected @endif value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"/>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" value="{{ Auth::user()->name }}"/>
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" name="image" id="image" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" value="{{ old('status') }}">
                <option value="{{ App\Enums\NewsStatus::DRAFT->value }}">DRAFT</option>
                <option value="{{ App\Enums\NewsStatus::ACTIVE->value }}">ACTIVE</option>
                <option value="{{ App\Enums\NewsStatus::BLOCKED->value }}">BLOCKED</option>
            </select>  
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        </div>
        <br/>
        <button type="submit" class="btn btn-success">Save</button>
    </form>

    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
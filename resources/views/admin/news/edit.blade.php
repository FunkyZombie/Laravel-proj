@extends('layouts.admin')
@section('content') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать новость</h1>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <form method="POST" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Категории</label>
            <select class="form-select @error('categories') is-invalid @enderror" multiple name="categories[]" id="categories" >
                @foreach ($categories as $category)
                    <option @if(in_array($category->id, $news->categories->pluck('id')->toArray())) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $news->title }}"/>
            
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" value="{{ $news->author }}"/>
            
        </div>
        <div class="form-group">
            <img src="{{ Storage::disk()->url($news->image) }}" style="width: 150px; margin: 25px 0;"><br>
            <label for="image">Изображение</label>
            <input type="file" name="image" id="image" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" value="{{ old('status') }}">
                <option @if($news->status === 'draft') selected @endif value="{{ App\Enums\NewsStatus::DRAFT->value }}">DRAFT</option>
                <option @if($news->status === 'active') selected @endif value="{{ App\Enums\NewsStatus::ACTIVE->value }}">ACTIVE</option>
                <option @if($news->status === 'blocked') selected @endif value="{{ App\Enums\NewsStatus::BLOCKED->value }}">BLOCKED</option>
            </select>
            
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $news->description }}</textarea>
        </div>
        <br/>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            });
    </script>
@endsection

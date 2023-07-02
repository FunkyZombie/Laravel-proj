@extends('layouts.news')
@section('title') Новость "{{$news->title }}" @parent @endsection
@section('content')
    <div class="container news-item">
        <h2>{{$news->title}}</h2>
        <p>{{ $news->author }} - {{ $news->created_at }}</p>
        
        <p>{{$news->description}}</p>
    </div></br>
@endsection
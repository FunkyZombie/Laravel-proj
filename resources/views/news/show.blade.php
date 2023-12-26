@extends('layouts.news')
@section('title') Новость "{{$news->title }}" @parent @endsection
@section('content')
    <div class="container news-item ck-content" id="ck-content">
        
        <h2>{{$news->title}}</h2>
        <p>{{ $news->author }} - {{ $news->created_at }}</p>
        <img src="{{ Storage::disk()->url($news->image) }}" alt="" style="width: 350px">
        <?php echo $news->description?>
    </div>
    <br>
@endsection


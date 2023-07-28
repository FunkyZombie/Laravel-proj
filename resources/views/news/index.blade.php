@extends('layouts.news')
@section('title') Список новостей @parent @endsection
@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @forelse ($news as $item)
                <div class="col">
                    <div class="card shadow-sm">
                        @if ($item->image_url === null)
                            <img src="https://via.placeholder.com/640x480.png/001522?text=placeholder" alt="placeholder">
                        @else
                            <img src="{{ asset('/images/safdg.png') }}" alt="placeholder">
                        @endif
                        <div class="card-body">
                            <p><strong><a href="{{ route('news.show', ['news' => $item->id ]) }}">{{ $item->title }}</a></strong></p>
                            <p class="card-text card-scroll">{{ $item->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('news.show', ['news' => $item->id ]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                                </div>
                                <small class="text-body-secondary">{{ $item->author }} </small>  
                                {{-- $item->created_at->format('d-m-Y H:i')  --}}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>Новостей нет</h2>
            @endforelse
            
        </div>
        <div style="margin-top: 25px">
            {{ $news->links()}}
        </div>
        
    </div>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.admin')
@section('content') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Категории</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить категорию</a>
            </div>
        </div>
    </div>
    @if (!request())
        <x-alert :type="request()->get('type', 'success')" message="Some message"></x-alert>
    @endif
    <div class="table-responsive">
        @include('admin.message')
        <table class="table table-bordered" id="category">
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            @foreach ($categories as $item)
            <tr>
                <td>{{$item->id}}</th>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->created_at}}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['category' => $item]) }}">Edit</a>&nbsp;
                    <a href="javascript:;" data-id="{{ $item->id }}" class="deleted" style="color: red">Delete</a>

                </td>
            </tr>
            @endforeach
        <table>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            let table = document.querySelector("#category");
            table.addEventListener('click', (event) => {
                if (event.target.className === 'deleted') { 
                    let path = window.location.href + '/' + event.target.dataset.id;
                    if (confirm(`Подтвердите удаление записи с #ID = ${ event.target.dataset.id }`)) {
                        send(path).then(res => {
                            location.reload();
                        });
                    } else {
                        alert('Удаление отменено');
                    }
                }
            });

            async function send(url) {
                const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
                let response = fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': token
                    }
                }).then(res => res.json());
                return response;
            }
        });
    </script>

@endsection

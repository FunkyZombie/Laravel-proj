@extends('layouts.admin')
@section('content') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Пользователи</h1>
    </div>
    <div class="table-responsive">
        @include('admin.message')
        <table class="table table-bordered" id="users">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
            </tr>
            @foreach ($usersList as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->created_at}}</td>
                <td>
                    <a href="{{ route('admin.users.edit', ['user' => $item]) }}">Edit</a>&nbsp;
                </td>
            </tr>
            @endforeach
        <table>
        {{ $usersList->links()}}
        </div>

@endsection

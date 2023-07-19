
@extends('layouts.admin')
@section('content') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Изменить данные пользователя</h1>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    
    <form method="POST" action="{{ route('admin.users.update', ['user' => $user]) }}" >
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}"/>
        </div>
        <div class="form-check form-switch"> 
            <input class="form-check-input" name="appoint" type="checkbox" role="switch" id="flexSwitchCheckDefault" @if ($user->isAdmin) checked @endif>
            <label class="form-check-label" for="flexSwitchCheckDefault">Назначить как администратора?</label>
          </div>
        <br/>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
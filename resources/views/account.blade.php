@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('admin.message')
            <div class="card">
                <div class="card-header">{{ __('Account') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h3>
                            Здравствуйте, {{ Auth::user()->name }}
                        </h3>
                        @if (Auth::user()->isAdmin) <p><a href="{{ route('admin.index') }}" style="color: red">В админку</a></p> @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
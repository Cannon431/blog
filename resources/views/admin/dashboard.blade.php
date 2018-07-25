@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <h2 align="center">Админ панель</h2>
                    <h4>Здравствуйте, {{ Auth::user()->name }}!</h4>
                    <div class="card-body" style="margin-bottom: 12px;">
                        Добро пожаловать в панель администратора!
                    </div>
                    {!! Form::open(['method' => 'post', 'url' => '/logout']) !!}
                    {!! Form::token() !!}
                    <a href="{{ url('/') }}" class="btn btn-primary" style="display: inline-block; margin-right: 5px;">На главную</a>{!! Form::submit('Выйти', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

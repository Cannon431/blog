@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Создать новую категорию</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <br />
                        <br />

                        {!! Form::open(['url' => '/admin/categories', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.categories.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

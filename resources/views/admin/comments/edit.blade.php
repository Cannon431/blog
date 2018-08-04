@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Изменить комментарий #{{ $comment->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/comments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <br />
                        <br />

                        {!! Form::model($comment, [
                            'method' => 'PATCH',
                            'url' => ['/admin/comments', $comment->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.comments.form', ['submitButtonText' => 'Изменить'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

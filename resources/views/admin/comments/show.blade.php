@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Комментарий {{ $comment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/comments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/comments/' . $comment->id . '/edit') }}" title="Edit Comment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/comments', $comment->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Comment',
                                    'onclick'=>'return confirm("Вы действительно хотите удалить комментарий?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th>ID</th><td>{{ $comment->id }}</td></tr>
                                    <tr><th> Автор </th><td> {{ $comment->author }} </td></tr>
                                    <tr><th> E-mail </th><td> {{ $comment->email }} </td></tr>
                                    <tr><th> Текст </th><td> {{ $comment->text }} </td></tr>
                                    <tr><th> Пост </th><td> <a href="{{ url('post/' . $comment->post->id) }}">{{ $comment->post->title }}</a> </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

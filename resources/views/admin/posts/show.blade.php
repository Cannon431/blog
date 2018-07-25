@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Пост {{ $post->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/posts') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/posts/' . $post->id . '/edit') }}" title="Edit Post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/posts', $post->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Post',
                                    'onclick'=>'return confirm("Вы действительно хотите удалить пост?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $post->id }}</td>
                                    </tr>
                                    <tr><th> Название </th><td><a href="{{ url('post/' . $post->id) }}">{{ $post->title }}</a> </td></tr>
                                    <tr><th> Описание </th><td> {{ $post->description }} </td></tr>
                                    <tr><th> Текст </th><td> {{ $post->text }} </td></tr>
                                    <tr><th> Изображение </th> <td><img src="{{ asset('assets/images/posts/' . $post->image) }}" alt="{{ $post->title }}" width="400" height="300"></td></tr>
                                    <tr><th> Категория </th><td><a href="{{ url('category/' . $post->category->id) }}">{{ $post->category->name }}</a> </td></tr>
                                    <tr><th> Автор </th><td> {{ $post->author->name }} </td></tr>
                                    <tr><th> Комментарии </th><td> {{ $post->comments->count() }} </td></tr>
                                    <tr><th> Создано </th><td> {{ $post->created_at }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

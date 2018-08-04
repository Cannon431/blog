@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Автор {{ $author->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/authors') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/authors/' . $author->id . '/edit') }}" title="Edit Author"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/authors', $author->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Author',
                                    'onclick'=>'return confirm("Вы действительно хотите удалить автора?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $author->id }}</td>
                                    </tr>
                                    <tr><th> Имя </th><td> {{ $author->name }} </td></tr>
                                    <tr><th> Кол-во постов </th><td> {{ $author->posts->count() }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Комментарии ({{ $commentsQuantity }})</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/comments/create') }}" class="btn btn-success btn-sm" title="Add New Comment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Создать
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/comments', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Искать..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Автор</th>
                                        <th>E-mail</th>
                                        <th>Текст</th>
                                        <th>Пост</th>
                                        <th>Создано</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->author }}</td><td>{{ $item->email }}</td><td>{{ str_limit($item->text, 200) }}</td>
                                        <td><a href="{{ url('admin/posts/' . $item->post->id) }}">{{ $item->post->title }}</a></td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('/admin/comments/' . $item->id) }}" title="View Comment"><button class="btn btn-info btn-sm"> Смотреть</button></a>
                                            <a href="{{ url('/admin/comments/' . $item->id . '/edit') }}" title="Edit Comment"><button class="btn btn-primary btn-sm"> Изменить</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/comments', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Comment',
                                                        'onclick'=>'return confirm("Вы действительно хотите удалить комментарий?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $comments->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

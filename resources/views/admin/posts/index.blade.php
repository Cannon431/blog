@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Посты ({{ $postsQuantity }})</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/posts/create') }}" class="btn btn-success btn-sm" title="Add New Post">
                            <i class="fa fa-plus" aria-hidden="true"></i> Создать
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/posts', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Текст</th>
                                        <th>Просмотры</th>
                                        <th>Картинка</th>
                                        <th>Категория</th>
                                        <th>Автор</th>
                                        <th>Комментарии</th>
                                        <th>Создано</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td><a href="{{ url('post/' . $item->id) }}">{{ $item->title }}</a></td>
                                        <td>{{ str_limit($item->description, 150) }}</td>
                                        <td>{{ str_limit(strip_tags($item->text, 300)) }}</td>
                                        <td>{{ $item->views }}</td>
                                        <td><img src="{{ asset('assets/images/posts/' . $item->image) }}" alt="{{ $item->title }}" width="230" height="180"></td>
                                        <td><a href="{{ url('admin/categories/' . $item->category->id) }}">{{ $item->category->name }}</a></td>
                                        <td>{{ $item->author->name }}</td>
                                        <td>{{ $item->comments->count() }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('/admin/posts/' . $item->id) }}" title="View Post"><button class="btn btn-info btn-sm"> Смотреть</button></a>
                                            <a href="{{ url('/admin/posts/' . $item->id . '/edit') }}" title="Edit Post"><button class="btn btn-primary btn-sm"> Изменить</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/posts', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Post',
                                                        'onclick'=>'return confirm("Вы действительно хотите удалить пост?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $posts->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

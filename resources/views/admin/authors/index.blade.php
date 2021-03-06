@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Авторы ({{ $authorsQuantity }})</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/authors/create') }}" class="btn btn-success btn-sm" title="Add New Author">
                            <i class="fa fa-plus" aria-hidden="true"></i> Создать
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/authors', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>#</th><th>Имя</th><th>Кол-во постов</th><th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->posts_count }}</td>
                                        <td>
                                            <a href="{{ url('/admin/authors/' . $item->id) }}" title="View Author"><button class="btn btn-info btn-sm"> Смотреть</button></a>
                                            <a href="{{ url('/admin/authors/' . $item->id . '/edit') }}" title="Edit Author"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/authors', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Author',
                                                        'onclick'=>'return confirm("Вы действительно хотите удалить автора?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $authors->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

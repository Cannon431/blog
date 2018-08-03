@extends('layouts.main')
@section('title') Главная страница @endsection
@section('content')

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            @foreach($posts as $post)
                <article class="post">
                    <div class="post-thumb">
                        <a href="{{ url('post/' . $post->id) }}">
                            <img src="{{ asset('assets/images/posts/' . $post->image) }}" alt="">
                        </a>

                        <a href="{{ url('post/' . $post->id) }}" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">View Post</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="{{ url('category/' . $post->category->id) }}"> {{ $post->category->name }}</a></h6>
                            <h1 class="entry-title"><a href="{{ url('post/' . $post->id) }}">{{ $post->title }}</a></h1>
                            @auth
                                <a href="{{ url('admin/posts/' . $post->id . '/edit/') }}"><b>Изменить</b></a>
                            @endauth
                        </header>
                        <div class="entry-content">
                            <p>{{ $post->description }}</p>

                            <div class="btn-continue-reading text-center text-uppercase">
                                <a href="{{ url('post/' . $post->id) }}" class="more-link">Продолжить чтение</a>
                            </div>
                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">{{ $post->author->name }},  {{ $post->created_at }}</span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="{{ url('post/' . $post->id) }}"><i class="fa fa-comments"></i></a></li>{{ $post->comments_count }}
                                <li><a class="s-facebook" href="{{ url('post/' . $post->id) }}"><i class="fa fa-eye"></i></a></li>{{ $post->views }}
                            </ul>
                        </div>
                    </div>
                </article>
            @endforeach
                {{ $posts->links() }}
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection
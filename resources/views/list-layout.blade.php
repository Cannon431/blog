@extends('layouts.main')
@section('title') {{ $category->name }} @endsection
@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $category->name }} @auth
                            <small>
                                <a href="{{ url('admin/categories/' . $category->id . '/edit/') }}"><b>Изменить</b></a>
                            </small>
                        @endauth
                    </h2>
                    <br>
                    @if($posts !== false)
                        @foreach($posts as $post)
                            <article class="post post-list">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="post-thumb">
                                            <a href="{{ url('post/' . $post->id) }}"><img
                                                        src="{{ asset('assets/images/posts/' . $post->image) }}"
                                                        alt="{{ $post->title }}" class="pull-left"></a>

                                            <a href="{{ url('post/' . $post->id) }}"
                                               class="post-thumb-overlay text-center">
                                                <div class="text-uppercase text-center">View Post</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="post-content">
                                            <header class="entry-header text-uppercase">
                                                <h6>
                                                    <a href="{{ url('category/' . $post->category->id ) }}"> {{ $post->category->name }}</a>
                                                </h6>
                                                <h1 class="entry-title"><a
                                                            href="{{ url('post/' . $post->id) }}">{{ $post->title }}</a>
                                                </h1>
                                                @auth
                                                    <a href="{{ url('admin/posts/' . $post->id . '/edit/') }}"><b>Изменить</b></a>
                                                @endauth
                                            </header>
                                            <div class="entry-content">
                                                <p style="font-size: 13px;">{{ $post->description }}</p>
                                            </div>
                                            <div class="social-share">
                                                <span class="social-share-title pull-left text-capitalize">{{ $post->author->name }}
                                                    , {{ $post->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        {{ $posts->links() }}
                    @else
                        <h1>Постов пока-что нет.</h1>
                    @endif
                </div>
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
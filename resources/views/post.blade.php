@extends('layouts.main')
@section('title') {{ $post->title }} @endsection
@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="post">
                        <div class="post-thumb">
                            <a href="{{ url('post/' . $post->id) }}">
                                <img src="{{ asset('assets/images/posts/' . $post->image) }}" alt="">
                            </a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6>
                                    <a href="{{ url('category/' . $post->category->id) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </h6>

                                <h1 class="entry-title">
                                    <a href="{{ url('post/' . $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </h1>

                            </header>
                            <div class="entry-content">
                                <p>{!! $post->description !!}</p>
                                <hr>
                                <p>{!! $post->text !!}</p>
                            </div>

                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">{{ $post->author->name }}
                                    , {{ $post->created_at }}</span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="{{ url('post/' . $post->id) }}"><i
                                                    class="fa fa-eye"></i></a></li>{{ $post->views }}
                                </ul>
                            </div>
                        </div>
                    </article>
                    <div class="top-comment"><!--top comment-->
                        <img src="{{ asset('assets/images/authors/' . $post->author->image) }}"
                             class="pull-left img-circle" alt="{{ $post->author->name }}" width="85" height="85">
                        <h4>{{ $post->author->name }}</h4>
                        <p>{{ $post->author->about }}</p>
                    </div><!--top comment end-->
                    @if(count($recommendedPosts) > 0)
                        <div class="related-post-carousel"><!--related post carousel-->
                            <div class="related-heading">
                                <h4>Вам может понравится:</h4>
                            </div>
                            <div class="items">
                                @foreach($recommendedPosts as $post)
                                    <div class="single-item">
                                        <a href="{{ url('post/' . $post->id) }}">
                                            <img src="{{ asset('assets/images/posts/' . $post->image) }}"
                                                 alt="{{ $post->title }}" width="217" height="160">
                                            <p>{{ $post->title }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div><!--related post carousel-->
                    @endif
                    @if(count($post->comments) > 0)
                    <div class="bottom-comment">
                        <h3>Комментарии ({{ count($post->comments) }})</h3>
                        @foreach($post->comments as $comment)
                            <div class="bottom-comment"><!--bottom comment-->
                                <div class="comment-img">
                                    <img class="img-circle" src="{{ $comment->image }}"
                                         alt="{{ $comment->author }}" width="70" height="70">
                                </div>

                                <div class="comment-text">
                                    <h5>{{ $comment->author }}</h5>

                                    <p class="comment-date">
                                        {{ $comment->created_at }}
                                    </p>
                                    <p class="para">{{ $comment->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    <!-- end bottom comment-->
                    </div>
                    @endif

                    <div class="leave-comment"><!--leave comment-->
                        <h4>Оставьте свой комментарий</h4>
                        <form class="form-horizontal contact-form" role="form" method="post"
                              action="{{ url('comment/add/' . $post->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-6">
                                    @if($errors->has('name'))
                                        {{ $errors->first('name') }}
                                    @endif
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя" value="{{ Cookie::get('name') }}">
                                </div>
                                <div class="col-md-6">
                                    @if($errors->has('email'))
                                        {{ $errors->first('email') }}
                                    @endif
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="E-mail" value="{{ Cookie::get('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    @if($errors->has('message'))
                                        {{ $errors->first('message') }}
                                    @endif
                                    <textarea class="form-control" rows="6" name="message"
                                              placeholder="Сообщение"></textarea>
                                </div>
                            </div>
                            <button href="#" class="btn send-btn">Отправить комментарий</button>
                        </form>
                    </div><!--end leave comment-->
                </div>
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
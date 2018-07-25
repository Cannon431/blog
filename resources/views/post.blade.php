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
                                @auth
                                    <a href="{{ url('admin/posts/' . $post->id . '/edit/') }}"><b>Изменить</b></a>
                                @endauth
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
                <div id="comments">
                <h3>Комментарии ({{ $commentsCount }})</h3>
                    @if($commentsCount > 0)
                        @foreach($comments as $comment)
                            <div class="bottom-comment"><!--bottom comment-->
                                <div class="comment-img">
                                    <img class="img-circle" src="{{ $comment->image }}"
                                         alt="{{ $comment->author }}" width="70" height="70">
                                </div>
                                <div class="comment-text">
                                    <h5>{{ $comment->author }} @auth
                                            <small><a href="{{ url('admin/comments/' . $comment->id . '/edit/') }}"><b>Изменить</b></a></small>
                                        @endauth</h5>
                                    <p class="comment-date">
                                        {{ $comment->created_at }}
                                    </p>
                                    <p class="para">{{ $comment->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    <!-- end bottom comment-->
                        {{ $comments->links() }}
                    @endif
                </div>
                    <div class="leave-comment"><!--leave comment-->
                        <h4>Оставьте свой комментарий</h4>
                        <form class="form-horizontal contact-form" role="form"
                              action="{{ url('comment/add/' . $post->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-6">
                                    @if($errors->has('name'))
                                        {{ $errors->first('name') }}
                                    @endif
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя" value="@auth{{Auth::user()->name}}@endauth">
                                </div>
                                <div class="col-md-6">
                                    @if($errors->has('email'))
                                        {{ $errors->first('email') }}
                                    @endif
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="@auth{{Auth::user()->email}}@endauth">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    @if($errors->has('message'))
                                        {{ $errors->first('message') }}
                                    @endif
                                    <textarea class="form-control" rows="6" name="message"
                                              placeholder="Сообщение" id="message"></textarea>
                                </div>
                            </div>
                            <button id="leave-comment" class="btn send-btn">Отправить комментарий</button>
                        </form>
                    </div><!--end leave comment-->
                    <script src="{{ asset('/assets/js/md5.js') }}"></script>
                    <script>
                        function highlightInput(input, color = 'red') {
                            input.style.border = `1px solid ${color}`;
                            setTimeout(() => {
                                input.style.border = '';
                            }, 1500);
                        }
                        let leaveCommentButton = document.querySelector('#leave-comment');

                        leaveCommentButton.addEventListener('click', event => {
                            event.preventDefault();

                            let message = document.querySelector('#message'),
                                name = document.querySelector('#name'),
                                email = document.querySelector('#email');

                            if (message.value && name.value && email.value) {
                                fetch(
                                    `/comment/add/{{ $post->id }}?
                                        name=${name.value}
                                        &email=${email.value}
                                        &message=${message.value}`,
                                    {
                                        method: 'GET',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    }
                                )
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.ok) {
                                            let months = [
                                                'Января', 'Февраля', 'Марта', 'Апреля',
                                                'Мая', 'Июня', 'Июля', 'Августа',
                                                'Сентября', 'Октября', 'Ноября', 'Декабря'
                                            ];

                                            let date = new Date(),
                                                day = date.getDate(),
                                                month = months[date.getMonth()],
                                                year = date.getFullYear(),
                                                hours = date.getHours(),
                                                minutes = date.getMinutes().toString().length === 1 ? '0' + date.getMinutes() : date.getMinutes();

                                            let gravatarHash = md5(email.value.trim().toLowerCase());

                                            let newComment = document.createElement('div');
                                            newComment.classList.add('bottom-comment');
                                            newComment.innerHTML = '<div class="comment-img">' +
                                                    `<img class="img-circle" src="https://www.gravatar.com/avatar/${gravatarHash}" ` +
                                                    `alt="${name.value}" width="70" height="70">` +
                                                    '</div>' +
                                                    `<div class="comment-text">
                                                    <h5>${name.value}</h5>
                                                    <p class="comment-date">${day} ${month} ${year}, в ${hours}:${minutes}</p>
                                                    <p class="para">${message.value}</p>
                                                    </div>`;

                                            let comments = document.querySelector('#comments'),
                                                commentsQuantityElement = comments.getElementsByTagName('h3')[0],
                                                commentsQuantity = commentsQuantityElement.innerHTML.match(/\((\d+)\)/)[1];

                                            commentsQuantity++;
                                            commentsQuantityElement.innerHTML = `Комментарии (${commentsQuantity})`;

                                            comments.insertBefore(newComment, comments.children[1]);

                                            message.value = '';
                                            @guest
                                                name.value = '';
                                                email.value = '';
                                            @endguest

                                            highlightInput(message, 'lime');
                                            highlightInput(name, 'lime');
                                            highlightInput(email, 'lime');
                                        } else {
                                            if ('name' in data.errors) highlightInput(name);
                                            if ('email' in data.errors) highlightInput(email);
                                            if ('message' in data.errors) highlightInput(message);
                                        }
                                    });
                            } else {
                                if (!message.value) highlightInput(message);
                                if (!name.value) highlightInput(name);
                                if (!email.value) highlightInput(email);
                            }
                        });
                    </script>
                </div>
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
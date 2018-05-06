<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Популярные посты</h3>
        @foreach($popularPosts as $post)
            <div class="popular-post">
                <a href="{{ url('post/' . $post->id) }}" class="popular-img"><img src="{{ asset('assets/images/posts/' . $post->image) }}" alt="{{ $post->title }}">
                    <div class="p-overlay"></div>
                </a>
                <div class="p-content">
                    <a href="{{ url('post/' . $post->id) }}" class="text-uppercase">{{ $post->title }}</a>
                    <span class="p-date">{{ $post->created_at }}</span>
                </div>
            </div>
        @endforeach
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Последние посты</h3>
        @foreach($recentlyPosts as $post)
            <div class="thumb-latest-posts">

                <div class="media">
                    <div class="media-left" style="margin-bottom: 15px;">
                        <a href="{{ url('post/' . $post->id) }}" class="popular-img"><img src="{{ asset('assets/images/posts/' . $post->image) }}" alt="{{ $post->title }}">
                            <div class="p-overlay"></div>
                        </a>
                    </div>
                    <div class="p-content">
                        <a href="{{ url('post/' . $post->id) }}" class="text-uppercase">{{ $post->title }}</a>
                        <span class="p-date">{{ $post->created_at }}</span>
                    </div>
                </div>
            </div>
        @endforeach
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Категории</h3>
            <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ url('category/' . $category->id) }}">{{ $category->name }}</a>
                    <span class="post-count pull-right"> ({{ $category->posts()->count() }})</span>
                </li>
            @endforeach
            </ul>
        </aside>
    </div>
</div>
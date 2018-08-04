<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Меню
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation"><a href="{{ url('/admin') }}">Админ панель</a></li>
                <li role="presentation"><a href="{{ url('/admin/posts') }}">Посты ({{ $postsQuantity }})</a></li>
                <li role="presentation"><a href="{{ url('/admin/comments') }}">Комментарии ({{ $commentsQuantity }})</a></li>
                <li role="presentation"><a href="{{ url('/admin/categories') }}">Категории ({{ $categoriesQuantity }})</a></li>
                <li role="presentation"><a href="{{ url('/admin/authors') }}">Авторы ({{ $authorsQuantity }})</a></li>
                <li role="presentation"><a href="{{ url('/admin/users') }}">Пользователи ({{ $usersQuantity }})</a></li>
            </ul>
        </div>
    </div>
</div>

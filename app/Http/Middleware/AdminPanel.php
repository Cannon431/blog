<?php

namespace App\Http\Middleware;

use App\Post;
use App\Category;
use App\Author;
use App\Comment;
use App\User;
use Closure;
use View;
use Auth;

class AdminPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) return redirect('/login');

        View::share('postsQuantity', Post::count());
        View::share('categoriesQuantity', Category::count());
        View::share('authorsQuantity', Author::count());
        View::share('commentsQuantity', Comment::count());
        View::share('usersQuantity', User::count());

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Category;
use App\Post;
use Closure;
use View;

class Blog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('popularPosts', Post::getPopularPosts(Post::POPULAR_QUANTITY));
        View::share('recentlyPosts', Post::getRecentlyPosts(Post::RECENTLY_QUANTITY));
        View::share('categories', Category::getCategories());

        return $next($request);
    }
}

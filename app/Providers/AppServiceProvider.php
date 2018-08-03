<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Category;
use View;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('posts') && Schema::hasTable('categories')) {
            View::share('categories', Category::getCategories());
            View::share('popularPosts', Post::getPopularPosts(Post::POPULAR_QUANTITY));
            View::share('recentlyPosts', Post::getRecentlyPosts(Post::RECENTLY_QUANTITY));
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

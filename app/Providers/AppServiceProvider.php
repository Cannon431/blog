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
            View::share('popularPosts', Post::getPopularPosts(4));
            View::share('recentlyPosts', Post::getRecentlyPosts(4));
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

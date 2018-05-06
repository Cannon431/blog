<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function getPosts($limit)
    {
        return Post::orderBy('id', 'desc')
            ->paginate($limit);
    }
    public static function getRecentlyPosts($limit)
    {
        return Post::orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    public static function getPopularPosts($limit)
    {
        return Post::orderBy('views', 'desc')
            ->limit($limit)
            ->get();
    }

    public static function getPostsByCategory($limit, $categoryId)
    {
        return Post::orderBy('id', 'desc')
            ->where('category_id', '=', $categoryId)
            ->paginate($limit);
    }

    public static function getPost($id)
    {
        return Post::where('id', '=', $id)
            ->with('comments')
            ->firstOrFail();
    }

    public static function getRecommendedPosts($categoryId, $postId, $limit)
    {
        return Post::where([
            ['category_id', '=', $categoryId],
            ['id', '<>', $postId]])
            ->limit($limit)
            ->get();
    }

    public static function increaseViews($post, $views = 1)
    {
        return $post->increment('views', $views);
    }

    public function getCreatedAtAttribute($value)
    {
        $date = \Carbon\Carbon::parse($value)->format('j %n% Y, в H:i');

        return preg_replace_callback('/%([0-9]{1,2})%/', function ($matches) {
            $months = [
                'Января', 'Февраля', 'Марта', 'Декабря',
                'Апреля', 'Мая', 'Июня', 'Июля',
                'Августа', 'Сенятбря', 'Октября', 'Ноября'
            ];

            return $months[$matches[1] - 1];
        }, $date);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    const IN_HOME_PAGE = 4;
    const IN_BY_CATEGORIES_PAGE = 10;
    const POPULAR_QUANTITY = 4;
    const RECENTLY_QUANTITY = 4;
    const RECOMMENDED_QUANTITY = 6;

    protected $fillable = ['title', 'description', 'image', 'text', 'category_id', 'author_id'];

    public static function getPosts($limit)
    {
        return Post::with('category')
            ->withCount('comments')
            ->with('author')
            ->orderBy('id', 'desc')
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
        return Post::with('author')
            ->orderBy('id', 'desc')
            ->where('category_id', '=', $categoryId)
            ->paginate($limit);
    }

    public static function getPost($id)
    {
        return Post::with('comments')
            ->with('category')
            ->with('author')
            ->where('id', $id)
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

    public static function getToSelect()
    {
        $posts = Post::all();
        $postsData = [];

        foreach ($posts as $post) {
            $postsData[$post->id] = $post->title;
        }

        return $postsData;
    }

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value)
            ->addHours(session()->get('timezone'))
            ->format("j %n% Y, в H:i");

        return preg_replace_callback('/%([0-9]{1,2})%/', function ($matches) {
            $months = [
                'Января', 'Февраля', 'Марта', 'Декабря',
                'Апреля', 'Мая', 'Июня', 'Июля',
                'Августа', 'Сенятбря', 'Октября', 'Ноября'
            ];

            return $months[$matches[1]];
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

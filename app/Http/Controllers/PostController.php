<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Category;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::getPosts(4);

        return view('index', [
            'posts' => $posts
        ]);
    }

    public function post($id)
    {
        $post = Post::getPost($id);
        $comments = $post->comments()->paginate(Comment::PER_PAGE);
        $commentsCount = Comment::where('post_id', '=', $id)->count();

        if (!$post) {
            abort(404);
        }

        Post::increaseViews($post);
        $recommendedPosts = Post::getRecommendedPosts($post->category->id, $post->id, 6);

        return view('post', [
            'post' => $post,
            'recommendedPosts' => $recommendedPosts,
            'comments' => $comments,
            'commentsCount' => $commentsCount
        ]);
    }

    public function category($id)
    {
        $posts = Post::getPostsByCategory(10, $id);
        $category = Category::where('id', '=', $id)->first();

        if (empty($category)) {
            abort(404);
        }

        if ($posts->isEmpty()) {
            $posts = false;
        }

        return view('list-layout', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}

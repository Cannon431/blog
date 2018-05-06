<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::getPosts(5);

        return view('index', [
            'posts' => $posts
        ]);
    }

    public function post($id)
    {
        $post = Post::getPost($id);

        if (!$post) {
            abort(404);
        }

        Post::increaseViews($post);
        $recommendedPosts = Post::getRecommendedPosts($post->category->id, $post->id, 6);

        return view('post', [
            'post' => $post,
            'recommendedPosts' => $recommendedPosts
        ]);


    }

    public function category($id)
    {
        $posts = Post::getPostsByCategory(10, $id);

        return view('list-layout', [
            'posts' => $posts
        ]);
    }
}

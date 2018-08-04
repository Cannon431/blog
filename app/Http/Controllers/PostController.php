<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Category;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('index', [
            'posts' => Post::getPosts(POST::IN_HOME_PAGE)
        ]);
    }

    public function post($id)
    {
        $post = Post::getPost($id);
        $comments = Comment::get($post, Comment::PER_PAGE);

        Post::increaseViews($post);
        $recommendedPosts = Post::getRecommendedPosts(
            $post->category->id,
            $post->id,
            Post::RECOMMENDED_QUANTITY
        );

        return view('post', [
            'post' => $post,
            'postId' => $id,
            'recommendedPosts' => $recommendedPosts,
            'comments' => $comments
        ]);
    }

    public function category($id)
    {
        $posts = Post::getPostsByCategory(Post::IN_BY_CATEGORIES_PAGE, $id);
        $category = Category::getCategory($id);

        return view('list-layout', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}

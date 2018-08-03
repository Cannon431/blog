<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $comments = Comment::with('post')
                ->where('author', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('text', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate($perPage);
        } else {
            $comments = Comment::with('post')->latest()->paginate($perPage);
        }

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $posts = Post::getToSelect();
        return view('admin.comments.create', [
            'posts' => $posts,
            'default' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Comment::create($requestData);

        return redirect('admin/comments')->with('flash_message', 'Comment added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $posts = Post::getToSelect();

        foreach ($posts as $postId => $postTitle) {
            if ($postId == $comment->post_id) {
                $default = $postId;
            }
        }

        return view('admin.comments.edit', compact('comment', 'posts', 'default'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        
        $comment = Comment::findOrFail($id);
        $comment->update($requestData);

        return redirect('admin/comments')->with('flash_message', 'Comment updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Comment::destroy($id);

        return back();
    }
}

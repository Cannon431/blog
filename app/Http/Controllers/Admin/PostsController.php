<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Author;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
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
            $posts = Post::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('text', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $posts = Post::latest()->paginate($perPage);
        }

        $postsQuantity = Post::count();

        return view('admin.posts.index', compact('posts', 'postsQuantity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        list($categories, $authors) = [Category::getToSelect(), Author::getToSelect()];

        return view('admin.posts.create', [
            'categories' => $categories,
            'authors' => $authors
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

        if ($request->hasFile('image')) {

            $uploadPath = public_path('/assets/images/posts');

            $extension = $request['image']->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request['image']->move($uploadPath, $fileName);
            $requestData['image'] = $fileName;
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'category_id' => 'required',
            'author_id' => 'required'
        ], [
            'required' => 'Поле обязательно для заполнения!',
        ]);

        Post::create($requestData);

        return redirect('admin/posts')->with('flash_message', 'Post updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        list($categories, $authors) = [Category::getToSelect(), Author::getToSelect()];

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'authors' => $authors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();

        if ($request->hasFile('image')) {

            $uploadPath = public_path('/assets/images/posts');

            $extension = $request['image']->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request['image']->move($uploadPath, $fileName);
            $requestData['image'] = $fileName;
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'category_id' => 'required',
            'author_id' => 'required'
        ], [
            'required' => 'Поле обязательно для заполнения!',
        ]);

        $post = Post::findOrFail($id);
        $post->update($requestData);

        return redirect('admin/posts')->with('flash_message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect('admin/posts')->with('flash_message', 'Post deleted!');
    }
}

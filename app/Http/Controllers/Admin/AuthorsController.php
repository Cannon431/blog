<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
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
            $authors = Author::withCount('posts')
                ->where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $authors = Author::withCount('posts')
                ->latest()
                ->paginate($perPage);
        }

        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.authors.create');
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
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        Author::create($requestData);

        return redirect('admin/authors')->with('flash_message', 'Author added!');
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
        $author = Author::findOrFail($id);

        return view('admin.authors.show', compact('author'));
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
        $author = Author::findOrFail($id);

        return view('admin.authors.edit', compact('author'));
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
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $author = Author::findOrFail($id);
        $author->update($requestData);

        return redirect('admin/authors')->with('flash_message', 'Author updated!');
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
        Author::destroy($id);

        return redirect('admin/authors')->with('flash_message', 'Author deleted!');
    }
}

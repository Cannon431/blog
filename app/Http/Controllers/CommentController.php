<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|max:70',
            'message' => 'required|min:3|max:2000'
        ], [
            'required' => 'Поле обязательно для заполнения',
            'email' => 'Некорректный E-mail',
            'min' => 'Поле должно содержать не меньше :min символов',
            'max' => 'Поле должно содержать не больше :max символов'
        ]);

        $comment = new Comment();

        $comment->author = $request->name;
        $comment->email = $request->email;
        $comment->text = $request->message;
        $comment->post_id = $request->id;

        $comment->save();

        Comment::setCookieValues($request->name, $request->email);

        return back()->withCookies([cookie('name'), cookie('email')]);
    }
}

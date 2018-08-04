<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Comment;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        if (!$request->ajax()) abort(404);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|max:70',
            'message' => 'required|min:3|max:2000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'errors' => $validator->errors()
            ]);
        }

        $comment = new Comment();
        $comment->author = $request->name;
        $comment->email = $request->email;
        $comment->text = $request->message;
        $comment->post_id = $request->id;
        $comment->save();

        return response()->json(['ok' => true], 200);
    }
}

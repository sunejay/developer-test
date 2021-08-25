<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Events\CommentWritten;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function write($value='')
    {
        return view('comments.write');
    }

    public function save(Request $request)
    {
        $comment = new Comment();

        $request->validate([
            "body" => "required"
        ]);

        $comment->user_id = $request->user()->id;
        $comment->body = $request->body;
        $comment->save();

        if ($comment) {
            event(new CommentWritten($comment));
        }
        
        return back();

    }
}

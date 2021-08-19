<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentWritten;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function write(Request $request)
    {
        $comment = new Comment();

        $request->validate([
            "body" => "required"
        ]);

        $comment->user_id = $request->user()->id;
        $commentbody = $request->body;
        $comment->save();

        if ($comment) {
            event(new CommentWritten($comment));
        }
        
        return back();

    }
}

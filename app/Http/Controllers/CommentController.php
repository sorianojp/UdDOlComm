<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);
        Comment::create([
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);
        return back();
    }
    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
            'post_id' => $comment->post_id,
            'parent_id' => $comment->id,
        ]);

        return back();
    }
    public function delComment(Comment $comment)
    {
        if (auth()->user() && auth()->user()->id === $comment->user->id) {
            $comment->delete();
        }
        return back();
    }
}

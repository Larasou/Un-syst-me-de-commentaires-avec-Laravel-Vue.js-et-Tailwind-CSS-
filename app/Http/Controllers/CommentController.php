<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderByDesc('created_at')->get();

        return response($comments, 200);
    }


    public function store(Request $request)
    {
        $request->validate(['body' => 'required']);

        $comment = auth()->user()->comments()->create($request->all());

        return response($comment->load('user'), 200);
    }


    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate(['body' => 'required']);

        $comment->update($request->all());

        return response($comment->load('user'), 200);
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        return response('Le commentaire é bien été supprimé!', 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'is_approved' => false,
        ]);

        if ($request->ajax()) {
            return new CommentResource($comment);
        }

        return redirect()->route('posts.show', ['post' => $post->id])->with('successMessage', 'Комментарий успешно добавлен и поставлен на модерацию!');
    }

    public function moderationIndex()
    {
        $comments = Comment::where('is_approved', false)->get();

        return view('comments.moderation', compact('comments'));
    }

    public function approveComment(Comment $comment)
    {
        $comment->update(['is_approved' => true]);

        return redirect()->route('comments.moderationIndex')->with('successMessage', 'Комментарий одобрен!');
    }

    public function rejectComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.moderationIndex')->with('successMessage', 'Комментарий отклонен и удален!');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post->comments()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', ['post' => $post->id])->with('successMessage', 'Комментарий успешно добавлен!');
    }

}
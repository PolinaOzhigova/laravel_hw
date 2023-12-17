<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

        if ($request->ajax()) {
            return Response::json(['successMessage' => 'Комментарий успешно добавлен!']);
        }

        return redirect()->route('posts.show', ['post' => $post->id])->with('successMessage', 'Комментарий успешно добавлен!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->searchByCategory($request->category);
        }

        $posts = $query->get();
        $categories = Category::all();

        if ($request->wantsJson()) {
            return Response::json(['posts' => $posts, 'categories' => $categories]);
        }

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments;

        if (request()->wantsJson()) {
            return Response::json(['post' => $post, 'comments' => $comments]);
        }

        return view('posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        $categories = Category::all();

        if (request()->wantsJson()) {
            return Response::json(['categories' => $categories]);
        }

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->wantsJson()) {
            return new PostResource($post);
        }

        return redirect()->route('posts.index')->with('successMessage', 'Пост успешно создан!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        if (request()->wantsJson()) {
            return Response::json(['post' => $post, 'categories' => $categories]);
        }

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->wantsJson()) {
            return new PostResource($post);
        }

        return redirect()->route('posts.index')->with('successMessage', 'Пост успешно обновлен!');
    }

    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Пост и связанные комментарии успешно удалены!']);
        }

        return redirect()->route('posts.index')->with('successMessage', 'Пост и связанные комментарии успешно удалены!');
    }
}
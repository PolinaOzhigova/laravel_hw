<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Events\PostStatusChanged;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('status', 'published');

        if ($request->has('category') && $request->category !== 'all') {
            $query->searchByCategory($request->category);
        }

        $posts = $query->get();
        $categories = Category::all();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['posts' => $posts, 'categories' => $categories]);
        }

        return view('posts.index', compact('posts', 'categories'));
    }


    public function show(Request $request, Post $post)
    {
        $comments = $post->comments()->where('is_approved', true)->get();

        if ($request->ajax() || $request->wantsJson()) {
            return Response::json(['post' => $post, 'comments' => $comments]);
        }

        return view('posts.show', compact('post', 'comments'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax() || $request->wantsJson()) {
            return Response::json(['categories' => $categories]);
        }

        return view('posts.create', compact('categories'));
    }

    public function publishDraft(Request $request, Post $post)
    {
        $post->update([
            'status' => 'published',
            'publish_at' => now(),
        ]);

        event(new PostStatusChanged($post));


        if ($request->ajax() || $request->wantsJson()) {
            return new PostResource($post);
        }

        return redirect()->route('posts.drafts')->with('successMessage', 'Черновик успешно опубликован!');
    }

    public function drafts(Request $request)
    {
        $drafts = Post::where('status', 'draft')->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['drafts' => $drafts]);
        }

        return view('posts.drafts', compact('drafts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $status = $request->input('action') === 'drafts' ? 'draft' : 'published';

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'status' => $status,
            'publish_at' => $status === 'published' ? now() : null,
        ]);

        \Log::info('Post created:', ['post' => $post]);

        if ($request->ajax() || $request->wantsJson()) {
            return new PostResource($post);
        }

        $message = $status === 'draft' ? 'Черновик успешно сохранен!' : 'Пост успешно создан!';
        return redirect()->route('posts.index')->with('successMessage', $message);
    }


    public function unpublishPost(Request $request, Post $post)
    {
        $post->update([
            'status' => 'draft',
            'publish_at' => null,
        ]);

        event(new PostStatusChanged($post));

        if ($request->ajax() || $request->wantsJson()) {
            return new PostResource($post);
        }

        return redirect()->route('posts.index')->with('successMessage', 'Пост успешно снят с публикации!');
    }

    
    public function edit(Request $request, Post $post)
    {
        $categories = Category::all();

        if ($request->wantsJson()) {
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

        if ($request->ajax() || $request->wantsJson()) {
            return new PostResource($post);
        }

        return redirect()->route('posts.index')->with('successMessage', 'Пост успешно обновлен!');
    }

    public function destroy(Request $request, Post $post)
    {
        $post->comments()->delete();
        $post->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Пост и связанные комментарии успешно удалены!']);
        }

        return redirect()->route('posts.index')->with('successMessage', 'Пост и связанные комментарии успешно удалены!');
    }
}
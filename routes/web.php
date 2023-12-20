<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/submit-form', [HomeController::class, 'submitForm'])->name('submitForm');

use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/drafts', [PostController::class, 'drafts'])->name('posts.drafts');
Route::put('/posts/{post}/publish', [PostController::class, 'publishDraft'])->name('posts.publishDraft');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/posts/{post}/comments', 'CommentController@store')->name('comments.store');
Route::put('/posts/{post}/unpublish', [PostController::class, 'unpublishPost'])->name('posts.unpublish');


use App\Http\Controllers\CommentController;

Route::get('/comments/moderation', [CommentController::class, 'moderationIndex'])->name('comments.moderationIndex');
Route::put('/comments/{comment}/approve', [CommentController::class, 'approveComment'])->name('comments.approve');
Route::delete('/comments/{comment}', [CommentController::class, 'rejectComment'])->name('comments.reject');
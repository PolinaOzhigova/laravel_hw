<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'regex:/^[a-zA-Zа-яА-Я]+$/u'],
        ], [
            'title.regex' => 'Введите строку, состоящую только из букв.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('home')->with('successMessage', 'Данные успешно сохранены!');
    }
}
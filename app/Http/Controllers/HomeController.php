<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'data' => ['required', 'string', 'regex:/^[a-zA-Zа-яА-Я]+$/u'],
        ], [
            'data.regex' => 'Введите строку, состоящую только из букв.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        $fileName = 'data_' . uniqid() . '.json';
        file_put_contents(public_path('uploads/' . $fileName), json_encode(['data' => $request->input('data')]));

        return redirect()->route('home')->with('successMessage', 'Данные успешно сохранены!');
    }

}
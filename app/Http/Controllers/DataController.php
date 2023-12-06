<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $files = scandir(public_path('uploads'));
        $files = array_diff($files, ['.', '..']);

        $data = [];
        foreach ($files as $file) {
            $filePath = public_path('uploads/' . $file);
            $content = json_decode(file_get_contents($filePath), true);
            
            if ($content) {
                $data[] = $content;
            }
        }

        return view('data.index', compact('data'));
    }
}

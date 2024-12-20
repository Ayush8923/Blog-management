<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'posts' => Post::all(),
            'categories' => Category::all(),
        ]);
    }
}

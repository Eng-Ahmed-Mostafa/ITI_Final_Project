<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::paginate(10);
        $categories = Category::all();
        return view("welcome", compact("posts","categories"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::inRandomOrder()->with(['author', 'tags'])->withCount('comments')->take(7)->get();
        $comm =  \App\Models\Comment::with(['user', 'user.avatar', 'post'])->take(3)->get();
        $tags = \App\Models\Tag::select('name')->take(4)->get();

        return view('home', compact('posts', 'comm', 'tags'));
    }
}

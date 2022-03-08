<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = \App\Models\Post::published()
                ->latestPublished()
                ->with(['author', 'tags', 'cover'])
                ->withCount('comments')
                ->limit(10)
                ->get();
        
        $comm = \App\Models\Comment::joinPosts(['slug', 'title'])->publishedPost()->limit(3)->with('user', 'user.avatar')->get();
        
        $categories  = \App\Models\Category::select(['slug', 'name'])->get();
        
    }
}

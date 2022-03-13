<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
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
                // ->latestPublished()
                ->with(['author', 'tags', 'category','cover'])
                ->withCount('comments')
                ->limit(10)
                ->get();

        return new PostCollection($posts);
    }
}

<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = \App\Models\Post::published()
                                // ->lastWeek()
                                ->latestPublished()
                                ->with(['author', 'tags', 'cover'])
                                ->withCount('comments')
                                ->limit(10)
                                ->get();

        $comm = \App\Models\Comment::joinPosts(['slug', 'title'])->publishedPost()->limit(3)->with('user', 'user.avatar')->get();

        // $comm  = \App\Models\Comment::joinPostAndUser()
        //                             ->select(['comments.*', 'posts.slug as post_slug', 'posts.title as post_title', 'users.name'])
        //                             ->publishedPost()
        //                             ->limit(2)
        //                             ->with(['user', 'user.avatar'])
        //                             ->get();

        $categories  = \App\Models\Category::select(['slug', 'name'])->get();

        return view('home', compact('posts', 'comm', 'categories'));
    }
}

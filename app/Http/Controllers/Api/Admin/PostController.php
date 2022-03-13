<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{
    public function __invoke()
    {
        $posts = Post::get();

        return new PostCollection($posts);
    }
}

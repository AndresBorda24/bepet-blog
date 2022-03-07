<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function __invoke()
    {
        $table =  Post::class;
        $mt = ['authUser'];

        $fields = [
            'Titulo' => ['title', true],
            'Estado' => ['status', true],
            'slug' =>['slug', false]
        ];

        $filters = [
            'title' => ['type' => 'text'],
            // 'status' => ['type' => 'text'],
            'status' => [
                'type' => 'select', 
                'options' => [
                    'ARCHIVADO' => 'ARCHIVADO',
                    'BORRADOR' => 'BORRADOR',
                    'PUBLICADO' => 'PUBLICADO'
                ]
            ]
        ];
        // dd(json_encode($filters));
        return view('dashboard', compact('table', 'mt', 'fields', 'filters'));
    }
}

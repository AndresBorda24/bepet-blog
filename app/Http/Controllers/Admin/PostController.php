<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function __invoke()
    {
        $this->authorize('viewAny', \App\Models\Post::class);

        $table =  Post::class;
        $mt = ['joinUser'];

        $fields = [
            'Titulo' => ['title', true],
            'Estado' => ['status', true],
            'Usuario' => ['name', true],
            'slug' => ['slug', false],
        ];

        $filters = [
            'title' => ['type' => 'text0'],
            'status' => [
                'type' => 'select',
                'options' => [
                    'ARCHIVADO' => 'ARCHIVADO',
                    'BORRADOR' => 'BORRADOR',
                    'PUBLICADO' => 'PUBLICADO'
                ]],
            'name' => []
        ];

        // dd(collect($filters));

        return view('dashboard', compact('table', 'fields', 'mt', 'filters'));
    }
}

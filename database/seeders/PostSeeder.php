<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if (Storage::disk('public')->exists('postCovers')) {
            Storage::disk('public')->deleteDirectory('postCovers');
            Storage::disk('public')->makeDirectory('postCovers');
        }

        $posts = \App\Models\Post::factory(500)->create(); 

        foreach ($posts as $post) {
            \App\Models\PostCover::factory(1)->create([
                'Post_id' => $post->id
            ]);

            $post->tags()
                ->attach([
                    rand(1, 6),
                    rand(7, 12),
                ]);
        }
    }
}

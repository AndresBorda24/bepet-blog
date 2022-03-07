<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Storage::disk('public')->exists('Avatars')) {
            Storage::disk('public')->deleteDirectory('Avatars');
            Storage::disk('public')->makeDirectory('Avatars');
        }

        \App\Models\Avatar::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create(['role' => 'Admin']);
        \App\Models\Role::create(['role' => 'Manager']);
        \App\Models\Role::create(['role' => 'Writer']);

        $this->call(AvatarSeeder::class);

        $this->call(UserSeeder::class);

        \App\Models\Category::factory(7)->create();
        \App\Models\Tag::factory(12)->create();

        $this->call(PostSeeder::class);

        \App\Models\Comment::factory(70)->create();
        \App\Models\CommentReply::factory(20)->create();
    }
}

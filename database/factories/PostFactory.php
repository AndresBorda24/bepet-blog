<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence();
        $postStatus =  $this->faker->randomElement(['BORRADOR', 'PUBLICADO', 'ARCHIVADO']);
        return [
            'title' => $title,
            'extract' => $this->faker->text(200),
            'body' => $this->faker->text(3000),
            'status' => $postStatus,
            'slug' => Str::slug($title),
            'posted_at' => in_array($postStatus, ['PUBLICADO', 'ARCHIVADO']) ? now()->subDays(5) : NULL, 
            'user_id' => User::get(['id'])->random()->id,
            'category_id' => Category::get(['id'])->random()->id
        ];
    }
}

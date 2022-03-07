<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text(200),
            'user_id' => \App\Models\User::all(['id'])->random(),
            'post_id' => \App\Models\Post::all(['id'])->random()
        ];
    }
}

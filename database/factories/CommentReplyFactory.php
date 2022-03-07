<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text(),
            'user_id' => \App\Models\User::all(['id'])->random(),
            'comment_id' => \App\Models\Comment::all(['id'])->random()
        ];
    }
}

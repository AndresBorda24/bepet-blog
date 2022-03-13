<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostCoverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link' => 'postCovers/' . $this->faker->image('public/storage/postCovers', 320, 240, null, false),
        ];
    }
}

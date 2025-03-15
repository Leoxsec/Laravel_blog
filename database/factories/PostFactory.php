<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Associate with a random user
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}

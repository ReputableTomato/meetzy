<?php

namespace Database\Factories\Posts;

use App\Models\Posts\Post;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\User>
 */
class PostCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sentences = File::json(database_path('data/sentences.json'), true)["sentences"];
        $post = Post::first();

        return [
            'post_id' => $post->_id,
            'user' => $post->user,
            'content' => $this->faker->randomElement($sentences),
        ];
    }
}

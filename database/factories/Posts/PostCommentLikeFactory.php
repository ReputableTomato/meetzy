<?php

namespace Database\Factories\Posts;

use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\User>
 */
class PostCommentLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_comment_id' => PostComment::first()->id,
            'user_id' => User::first()->id,
        ];
    }
}

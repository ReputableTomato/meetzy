<?php

namespace App\Facades\User\Posts;

use Illuminate\Support\Facades\Facade;

/**
 * Class PostCommentServiceFacade
 * @mixin \App\Services\User\Posts\PostCommentService
 * @package App\Facades\User\Posts
 */
class PostCommentServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'post-comment-service'; }
}

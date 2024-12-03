<?php

namespace App\Facades\User\Posts;

use Illuminate\Support\Facades\Facade;

/**
 * Class PostLikeServiceFacade
 * @mixin \App\Services\User\Posts\PostLikeService
 * @package App\Facades\User\Posts
 */
class PostLikeServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'post-like-service'; }
}

<?php

namespace App\Facades\User\Posts;

use Illuminate\Support\Facades\Facade;

/**
 * Class PostServiceFacade
 * @mixin \App\Services\User\Posts\PostComment
 * @package App\Facades\User\Posts
 */
class PostServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'post-service'; }
}

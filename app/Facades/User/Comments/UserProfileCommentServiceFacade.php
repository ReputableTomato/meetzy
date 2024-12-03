<?php

namespace App\Facades\User\Comments;

use Illuminate\Support\Facades\Facade;

/**
 * Class UserProfileCommentServiceFacade
 * @mixin \App\Services\User\Comments\UserProfileCommentService
 * @package App\Facades\User\Comments
 */
class UserProfileCommentServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'user-profile-comment-service'; }
}

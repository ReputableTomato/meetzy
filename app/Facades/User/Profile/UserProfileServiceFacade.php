<?php

namespace App\Facades\User\Profile;

use Illuminate\Support\Facades\Facade;

/**
 * Class UserProfileServiceFacade
 * @mixin \App\Services\User\Profile\UserProfileService
 * @package App\Facades\User
 */
class UserProfileServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'user-profile-service'; }
}

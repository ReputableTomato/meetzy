<?php

namespace App\Facades\User;

use Illuminate\Support\Facades\Facade;

/**
 * Class UserServiceFacade
 * @mixin \App\Services\User\UserService
 * @package App\Facades\User
 */
class UserServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'user-service'; }
}

<?php

namespace App\Facades\Authentication;

use Illuminate\Support\Facades\Facade;

/**
 * Class AuthenticationServiceFacade
 * @mixin \App\Services\Authentication\AuthenticationService
 * @package App\Facades\Authentication\AuthenticationServiceFacade
 */
class AuthenticationServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'authentication-service'; }
}

<?php

namespace App\Facades\Authentication;

use Illuminate\Support\Facades\Facade;

/**
 * Class ForgottenPasswordServiceFacade
 * @mixin \App\Services\Authentication\ForgottenPasswordService
 * @package App\Facades\Authentication\ForgottenPasswordServiceFacade
 */
class ForgottenPasswordServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'forgotten-password-service'; }
}

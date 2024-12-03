<?php

namespace App\Facades\Authentication;

use Illuminate\Support\Facades\Facade;

/**
 * Class RegistrationServiceFacade
 * @mixin \App\Services\Authentication\RegistrationService
 * @package App\Facades\Authentication\RegistrationServiceFacade
 */
class RegistrationServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'registration-service'; }
}

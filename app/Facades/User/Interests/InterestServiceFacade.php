<?php

namespace App\Facades\User\Interests;

use Illuminate\Support\Facades\Facade;

/**
 * Class InterestServiceFacade
 * @mixin \App\Services\User\Interests\InterestService
 * @package App\Facades\User\Languages
 */
class InterestServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'interest-service'; }
}

<?php

namespace App\Facades\User\Logs;

use Illuminate\Support\Facades\Facade;

/**
 * Class LogServiceFacade
 * @mixin \App\Services\User\Logs\LogService
 * @package App\Facades\User\Logs
 */
class LogServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'logs-service'; }
}

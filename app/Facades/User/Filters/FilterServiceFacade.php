<?php

namespace App\Facades\User\Filters;

use Illuminate\Support\Facades\Facade;

/**
 * Class FilterServiceFacade
 * @mixin \App\Services\User\Filters\FilterService
 * @package App\Facades\Filters\FilterServiceFacade
 */
class FilterServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'filter-service'; }
}

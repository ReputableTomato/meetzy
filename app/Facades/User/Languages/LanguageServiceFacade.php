<?php

namespace App\Facades\User\Languages;

use Illuminate\Support\Facades\Facade;

/**
 * Class LanguageServiceFacade
 * @mixin \App\Services\User\Languages\LanguageService
 * @package App\Facades\User\Languages
 */
class LanguageServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'language-service'; }
}

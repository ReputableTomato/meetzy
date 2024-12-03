<?php

namespace App\Facades\User\Friends;

use Illuminate\Support\Facades\Facade;

/**
 * Class PostServiceFacade
 * @mixin \App\Services\User\Friends\FriendsService
 * @package App\Facades\User\Friends
 */
class FriendsServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'friends-service'; }
}

<?php

namespace App\Facades\Chat;

use Illuminate\Support\Facades\Facade;

/**
 * Class ChatServiceFacade
 * @mixin \App\Services\Chat\ChatService
 * @package App\Facades\Chat
 */
class ChatServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'chat-service'; }
}

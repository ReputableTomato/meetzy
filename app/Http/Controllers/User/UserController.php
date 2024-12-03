<?php

namespace App\Http\Controllers\User;

use App\Facades\User\UserServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\BlockUserRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\GetUserListRequest;
use App\Http\Requests\User\SendFriendRequestRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @param GetUserListRequest $request
     * @return JsonResponse
     */
    public function getUserList(GetUserListRequest $request): JsonResponse
    {
        return UserServiceFacade::getUserList($request);
    }

    /**
     * @param GetUserRequest $request
     * @return JsonResponse
     */
    public function render(GetUserRequest $request): JsonResponse
    {
        return UserServiceFacade::getUser($request);
    }

    /**
     * @param BlockUserRequest $request
     * @return JsonResponse
     */
    public function blockUser(BlockUserRequest $request): JsonResponse
    {
        return UserServiceFacade::blockUser($request);
    }

    /**
     * @param GetUserRequest $request
     * @return JsonResponse
     */
    public function getUser(GetUserRequest $request): JsonResponse
    {
        return UserServiceFacade::getUser($request);
    }
}

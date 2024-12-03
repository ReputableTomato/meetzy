<?php

namespace App\Http\Controllers\User\Friends;

use App\Facades\User\Friends\FriendsServiceFacade;
use App\Facades\User\UserServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Friends\GetFriendsRequest;
use App\Http\Requests\User\SendFriendRequestRequest;
use Illuminate\Http\JsonResponse;

class FriendsController extends Controller
{
    /**#
     * Show the messages page.
     */
    public function index(): \Illuminate\View\View
    {
        return view('friends.index');
    }

    /**
     * @param GetFriendsRequest $request
     * @return JsonResponse
     */
    public function getFriends(GetFriendsRequest $request): JsonResponse
    {
        return FriendsServiceFacade::getFriends($request);
    }

    /**
     * @param SendFriendRequestRequest $request
     * @return JsonResponse
     */
    public function sendFriendRequest(SendFriendRequestRequest $request): JsonResponse
    {
        return FriendsServiceFacade::sendFriendRequest($request);
    }
}

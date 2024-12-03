<?php

namespace App\Http\Controllers\User;

use App\Facades\User\Profile\UserProfileServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\GetUserProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class UserProfileController extends Controller
{
    /**
     * @param GetUserProfileRequest $request
     * @return Response|JsonResponse
     */
    public function index(GetUserProfileRequest $request): Response|JsonResponse
    {
        return UserProfileServiceFacade::index($request);
    }
}

<?php

namespace App\Http\Controllers\User\Logs;

use App\Facades\User\Comments\UserProfileCommentServiceFacade;
use App\Facades\User\Logs\LogServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Comments\JsonResource;
use App\Http\Requests\User\Comments\CreateUserProfileCommentRequest;
use App\Http\Requests\User\Comments\DeleteUserProfileCommentRequest;
use App\Http\Requests\User\Comments\GetUserProfileCommentRequest;
use App\Http\Requests\User\Logs\GetUserProfileAccessLogsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class UserProfileLogsController
 * @package App\Http\Controllers\User\Logs
 */
class UserProfileLogsController extends Controller
{
    /**
     * @param GetUserProfileAccessLogsRequest $request
     * @return JsonResponse
     */
    public function access(GetUserProfileAccessLogsRequest $request): JsonResponse
    {
        return LogServiceFacade::access($request);
    }
}

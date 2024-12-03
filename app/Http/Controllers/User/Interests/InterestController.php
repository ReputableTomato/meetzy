<?php

namespace App\Http\Controllers\User\Interests;

use App\Facades\User\Interests\InterestServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Interests\GetInterestsRequest;
use Illuminate\Http\JsonResponse;

class InterestController extends Controller
{
    /**
     * @param GetInterestsRequest $request
     * @return JsonResponse
     */
    public function index(GetInterestsRequest $request): JsonResponse
    {
        return InterestServiceFacade::index($request);
    }
}

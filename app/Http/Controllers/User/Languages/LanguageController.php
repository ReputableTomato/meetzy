<?php

namespace App\Http\Controllers\User\Languages;

use App\Facades\User\Languages\InterestServiceFacade;
use App\Facades\User\Languages\LanguageServiceFacade;
use App\Facades\User\Posts\PostServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Languages\GetInterestsRequest;
use App\Http\Requests\User\Languages\GetLanguagesRequest;
use App\Http\Requests\User\Posts\GetPostsRequest;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    /**
     * @param GetLanguagesRequest $request
     * @return JsonResponse
     */
    public function index(GetLanguagesRequest $request): JsonResponse
    {
        return LanguageServiceFacade::index($request);
    }
}

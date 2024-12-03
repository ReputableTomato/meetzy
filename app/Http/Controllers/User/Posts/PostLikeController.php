<?php

namespace App\Http\Controllers\User\Posts;

use App\Facades\User\Posts\PostLikeServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Posts\TogglePostLikeRequest;
use App\Http\Requests\User\Posts\DeletePostLikeRequest;
use App\Http\Requests\User\Posts\GetPostLikesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * @param GetPostLikesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetPostLikesRequest $request): JsonResponse
    {
        return PostLikeServiceFacade::getLikes($request);
    }

    /**
     * @param TogglePostLikeRequest $request
     * @return JsonResponse
     */
    public function toggle(TogglePostLikeRequest $request): JsonResponse
    {
        return PostLikeServiceFacade::toggle($request);
    }

    /**
     * @param DeletePostLikeRequest $request
     * @return JsonResponse
     */
    public function destroy(DeletePostLikeRequest $request): JsonResponse
    {
        return PostLikeServiceFacade::destroy($request);
    }
}

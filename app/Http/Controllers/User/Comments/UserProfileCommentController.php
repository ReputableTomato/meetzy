<?php

namespace App\Http\Controllers\User\Comments;

use App\Facades\User\Comments\UserProfileCommentServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Comments\CreateUserProfileCommentRequest;
use App\Http\Requests\User\Comments\DeleteUserProfileCommentRequest;
use App\Http\Requests\User\Comments\GetUserProfileCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class UserProfileCommentController
 * @package App\Http\Controllers\User\Comments
 */
class UserProfileCommentController extends Controller
{
    /**
     * @param GetUserProfileCommentRequest $request
     * @return JsonResource
     */
    public function index(GetUserProfileCommentRequest $request): JsonResponse
    {
        return UserProfileCommentServiceFacade::index($request);
    }

    /**
     * @param CreateUserProfileCommentRequest $request
     * @return JsonResponse
     */
    public function create(CreateUserProfileCommentRequest $request): JsonResponse
    {
        return UserProfileCommentServiceFacade::create($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * @param DeleteUserProfileCommentRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteUserProfileCommentRequest $request): JsonResponse
    {
        return UserProfileCommentServiceFacade::destroy($request);
    }
}

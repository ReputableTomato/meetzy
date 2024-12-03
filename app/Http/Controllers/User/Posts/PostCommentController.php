<?php

namespace App\Http\Controllers\User\Posts;

use App\Facades\User\Posts\PostCommentServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Posts\Comments\DeletePostCommentRequest;
use App\Http\Requests\User\Posts\Comments\GetPostCommentRequest;
use App\Http\Requests\User\Posts\Comments\CreatePostCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * @param GetPostCommentRequest $request
     * @return JsonResponse
     */
    public function index(GetPostCommentRequest $request): JsonResponse
    {
        return PostCommentServiceFacade::getPostComments($request);
    }

    /**
     * @param CreatePostCommentRequest $request
     * @return JsonResponse
     */
    public function create(CreatePostCommentRequest $request): JsonResponse
    {
        return PostCommentServiceFacade::create($request);
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
     * @param DeletePostCommentRequest $request
     * @return JsonResponse
     */
    public function destroy(DeletePostCommentRequest $request): JsonResponse
    {
        return PostCommentServiceFacade::delete($request);
    }
}

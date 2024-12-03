<?php

namespace App\Http\Controllers\User\Posts;

use App\Facades\User\Posts\PostServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Posts\Comments\DeletePostCommentRequest;
use App\Http\Requests\User\Posts\Comments\GetPostCommentRequest;
use App\Http\Requests\User\Posts\CreateCommentReplyRequest;
use App\Http\Requests\User\Posts\CreatePostCommentRequest;
use App\Http\Requests\User\Posts\CreatePostRequest;
use App\Http\Requests\User\Posts\DeleteCommentReplyRequest;
use App\Http\Requests\User\Posts\DeletePostRequest;
use App\Http\Requests\User\Posts\DislikeCommentRequest;
use App\Http\Requests\User\Posts\DislikePostRequest;
use App\Http\Requests\User\Posts\GetPostRequest;
use App\Http\Requests\User\Posts\GetPostsRequest;
use App\Http\Requests\User\Posts\LikeCommentRequest;
use App\Http\Requests\User\Posts\LikePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $user = Auth::user()->load('friends', 'friend_requests');

        return view('posts.index', [
            'user' => $user
        ]);
    }

    /**
     * @param GetPostsRequest $request
     * @return JsonResponse
     */
    public function getPosts(GetPostsRequest $request): JsonResponse
    {
        return PostServiceFacade::getPosts($request);
    }

    /**
     * @param GetPostRequest $request
     * @return JsonResponse
     */
    public function getPost(GetPostRequest $request): JsonResponse
    {
        return PostServiceFacade::getPost($request);
    }

    /**
     * @param LikePostRequest $request
     * @return JsonResponse
     */
    public function likePost(LikePostRequest $request): JsonResponse
    {
        return PostServiceFacade::likePost($request);
    }

    /**
     * @param DislikePostRequest $request
     * @return JsonResponse
     */
    public function dislikePost(DislikePostRequest $request): JsonResponse
    {
        return PostServiceFacade::dislikePost($request);
    }

    /**
     * @param GetPostCommentRequest $request
     * @return JsonResponse
     */
    public function getPostComments(GetPostCommentRequest $request): JsonResponse
    {
        return PostServiceFacade::getPostComments($request);
    }

    /**
     * @param CreateCommentReplyRequest $request
     * @return JsonResponse
     */
    public function createCommentReply(CreateCommentReplyRequest $request): JsonResponse
    {
        return PostServiceFacade::createCommentReply($request);
    }

    /**
     * @param DeleteCommentReplyRequest $request
     * @return JsonResponse
     */
    public function deleteCommentReply(DeleteCommentReplyRequest $request): JsonResponse
    {
        return PostServiceFacade::deleteCommentReply($request);
    }

    /**
     * @param LikeCommentRequest $request
     * @return JsonResponse
     */
    public function likeComment(LikeCommentRequest $request): JsonResponse
    {
        return PostServiceFacade::likeComment($request);
    }

    /**
     * @param DislikeCommentRequest $request
     * @return JsonResponse
     */
    public function dislikeComment(DislikeCommentRequest $request): JsonResponse
    {
        return PostServiceFacade::dislikeComment($request);
    }

    /**
     * @param CreatePostRequest $request
     * @return JsonResponse
     */
    public function create(CreatePostRequest $request): JsonResponse
    {
        return PostServiceFacade::create($request);
    }

    /**
     * @param DeletePostRequest $request
     * @return JsonResponse
     */
    public function delete(DeletePostRequest $request): JsonResponse
    {
        return PostServiceFacade::delete($request);
    }

    /**
     * @param CreatePostCommentRequest $request
     * @return JsonResponse
     */
    public function createComment(CreatePostCommentRequest $request): JsonResponse
    {
        return PostServiceFacade::createComment($request);
    }

    /**
     * @param DeletePostCommentRequest $request
     * @return JsonResponse
     */
    public function deleteComment(DeletePostCommentRequest $request): JsonResponse
    {
        return PostServiceFacade::deleteComment($request);
    }
}

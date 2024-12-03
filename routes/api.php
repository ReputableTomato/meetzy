<?php

use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\User\Country\CountryController;
use App\Http\Controllers\User\Filters\FilterController;
use App\Http\Controllers\User\Gender\GenderController;
use App\Http\Controllers\User\Posts\PostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Friends\FriendsController;
use App\Http\Controllers\User\Languages\InterestController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\GenderSexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/filters/country/{id}', [FilterController::class, 'getCountry']);
    Route::get('/filters/settings', [FilterController::class, 'getSearchSettings']);
    Route::patch('/filters', [FilterController::class, 'updateFilters']);
    Route::get('/users', [UserController::class, 'getUserList']);

    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/post/{id}', [PostController::class, 'getPost']);
    Route::post('/post/{id}/like', [PostController::class, 'likePost']);
    Route::post('/post/{id}/dislike', [PostController::class, 'dislikePost']);
    Route::get('/post/{id}/comments', [PostController::class, 'getPostComments']);
    Route::post('/post/{id}/comment/{post_comment_id}/reply', [PostController::class, 'createCommentReply']);
    Route::delete('/post/comment/reply/{id}', [PostController::class, 'deleteCommentReply']);
    Route::post('/post/comment/{id}/like', [PostController::class, 'likeComment']);
    Route::post('/post/comment/{id}/dislike', [PostController::class, 'dislikeComment']);
    Route::post('/post', [PostController::class, 'create']);
    Route::delete('/post/{id}', [PostController::class, 'delete']);
    Route::post('/post/comment', [PostController::class, 'createComment']);
    Route::delete('/post/comment/{id}', [PostController::class, 'deleteComment']);

    Route::post('/user/block', [UserController::class, 'blockUser']);
    Route::get('/user/{username}', [UserController::class, 'getUser']);

    Route::get('/languages', [InterestController::class, 'getLanguages']);

    Route::post('/friend/request/{id}', [FriendsController::class, 'sendFriendRequest']);
    Route::get('/friends', [FriendsController::class, 'getFriends']);

    Route::get('/me', [UserController::class, 'getMe']);
});

Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/countries', [LocationController::class, 'getCountries']);
Route::get('/country/{id}', [LocationController::class, 'getCountry']);

Route::get('/genders', [GenderSexController::class, 'getGenders']);
Route::get('/sexes', [GenderSexController::class, 'getSexes']);

//Route::get('/event-test', function () {
//    event(new \App\Events\Chat\NewMessage(21, 'Hello World'));
//    return 'Event fired';
//});

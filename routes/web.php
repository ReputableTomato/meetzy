<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Authentication\ForgottenPasswordController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\Authentication\RegistrationRulesController;
use App\Http\Controllers\Authentication\RegistrationPrivacyPolicyController;
use App\Http\Controllers\Authentication\RegistrationConfirmationController;
use App\Http\Controllers\User\Posts\PostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Posts\PostLikeController;
use App\Http\Controllers\User\Posts\PostCommentController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\Interests\InterestController;
use App\Http\Controllers\User\Languages\LanguageController;
use App\Http\Controllers\User\Comments\UserProfileCommentController;
use App\Http\Controllers\User\Logs\UserProfileLogsController;
use App\Http\Controllers\Chat\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'render'])->name('login.render');
Route::get('/logout', [AuthenticationController::class, 'destroy'])->name('login.destroy');
Route::post('/login', [AuthenticationController::class, 'store'])->name('login.create');

Route::get('/forgotten-password', [ForgottenPasswordController::class, 'render'])->name('forgotten-password.render');
Route::post('/forgotten-password', [ForgottenPasswordController::class, 'store'])->name('forgotten-password.store');
Route::get('/forgotten-password/{token}', [ForgottenPasswordController::class, 'resetRender'])->name('forgotten-password.reset');
Route::post('/forgotten-password/{token}', [ForgottenPasswordController::class, 'save'])->name('forgotten-password.save');

Route::get('/registration', [RegistrationController::class, 'render'])->name('registration.render');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.create');
Route::post('/registration/confirm', [RegistrationConfirmationController::class, 'render'])->name('registration.confirm');
Route::get('/registration/{id}/resend', [RegistrationConfirmationController::class, 'resend'])->name('registration.resend');
Route::get('/registration/confirm/{token}', [RegistrationConfirmationController::class, 'confirm'])->name('registration.confirm.token');
Route::get('/registration/rules', [RegistrationRulesController::class, 'render'])->name('registration.rules.render');
Route::get('/registration/privacy-policy', [RegistrationPrivacyPolicyController::class, 'render'])->name('registration.privacy-policy.render');

Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'getPosts'])->name('post');
    Route::post('/', [PostController::class, 'create'])->name('post.create');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('post.delete');

    Route::get('/{id}/comments', [PostCommentController::class, 'index'])->name('post.comments.index');
    Route::post('/{id}/comment', [PostCommentController::class, 'create'])->name('post.comments.create');
    Route::delete('/{id}/comment/{comment_id}', [PostCommentController::class, 'destroy'])->name('post.comments.destroy');

    Route::prefix('likes')->group(function () {
        Route::get('/{id}', [PostLikeController::class, 'index'])->name('post.likes');
        Route::post('/{id}', [PostLikeController::class, 'toggle'])->name('post.likes.toggle');
    });
});

Route::get('languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('interests', [InterestController::class, 'index'])->name('interests.index');

Route::prefix('/logs')->group(function () {
    Route::get('/access', [UserProfileLogsController::class, 'access'])->name('logs.access');
});

Route::prefix('u')->group(function () {
    Route::get('/{username}', [UserProfileController::class, 'index'])->name('user.index');

    Route::prefix('/{username}/comments')->group(function () {
        Route::post('/', [UserProfileCommentController::class, 'create'])->name('user.comments.create');
        Route::get('/', [UserProfileCommentController::class, 'index'])->name('user.comments.index');
        Route::delete('/{id}', [UserProfileCommentController::class, 'destroy'])->name('user.comments.destroy');
    });
});

Route::get('/user', [UserController::class, 'render'])->name('user');
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

Route::get('/', [HomeController::class, 'render'])->name('home');

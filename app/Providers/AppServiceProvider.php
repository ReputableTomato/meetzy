<?php

namespace App\Providers;

use App\Services\Authentication\AuthenticationService;
use App\Services\Authentication\ForgottenPasswordService;
use App\Services\Chat\ChatService;
use App\Services\ElasticSearchService;
use App\Services\User\Comments\UserProfileCommentService;
use App\Services\User\Country\CountryService;
use App\Services\User\Filters\FilterService;
use App\Services\User\Friends\FriendsService;
use App\Services\User\Interests\InterestService;
use App\Services\User\Languages\LanguageService;
use App\Services\User\Logs\LogService;
use App\Services\User\Posts\PostCommentService;
use App\Services\User\Posts\PostLikeService;
use App\Services\User\Posts\PostService;
use App\Services\User\Profile\UserProfileService;
use App\Services\User\UserService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Image;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('authentication-service', function () {
            return new AuthenticationService();
        });

        $this->app->bind('registration-service', function () {
            return new AuthenticationService();
        });

        $this->app->bind('forgotten-password-service', function () {
            return new ForgottenPasswordService();
        });

        $this->app->bind('filter-service', function () {
            return new FilterService();
        });

        $this->app->bind('user-service', function () {
            return new UserService();
        });

        $this->app->bind('user-profile-service', function () {
            return new UserProfileService();
        });

        $this->app->bind('post-service', function () {
            return new PostService();
        });

        $this->app->bind('post-comment-service', function () {
            return new PostCommentService();
        });

        $this->app->bind('post-like-service', function () {
            return new PostLikeService();
        });

        $this->app->bind('friends-service', function () {
            return new FriendsService();
        });

        $this->app->bind('interest-service', function () {
            return new InterestService();
        });

        $this->app->bind('language-service', function () {
            return new LanguageService();
        });

        $this->app->bind('user-profile-comment-service', function () {
            return new UserProfileCommentService();
        });

        $this->app->bind('elasticsearch-service', function () {
            return new ElasticSearchService();
        });

        $this->app->bind('logs-service', function () {
            return new LogService();
        });

        $this->app->bind('chat-service', function () {
            return new ChatService();
        });

        $loader = AliasLoader::getInstance();

        $loader->alias('Image', Image::class);

        View::composer('*', function ($view) {
            if (Route::current() && Route::current()->uri() === 'chat') {
                $view->with('isChat', true);
            } else {
                $view->with('isChat', false);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}

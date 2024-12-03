<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('genders')) {
            Schema::create('genders', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
        }

        if (!Schema::hasTable('sexes')) {
            Schema::create('sexes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code');
            });
        }

        if (!Schema::hasTable('user_filters')) {
            Schema::create('user_filters', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->integer('age_from')->default(11);
                $table->integer('age_to')->default(120);
                $table->json('sexes')->default(json_encode([]));
                $table->json('genders')->default(json_encode([]));
                $table->json('countries')->default(json_encode([]));
                $table->integer('city')->nullable();
                $table->boolean('online')->nullable();
                $table->json('keywords')->default(json_encode([]));
                $table->string('username')->nullable();
                $table->json('interests')->default(json_encode([]));
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('interests')) {
            Schema::create('interests', function (Blueprint $table) {
                $table->id();
                $table->integer('user');
                $table->foreignId('interest_type_id');
            });
        }

        if (!Schema::hasTable('interest_types')) {
            Schema::create('interest_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
        }

        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->integer('minimum_age')->default(11);
                $table->integer('maximum_age')->default(120);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('post_likes')) {
            Schema::create('post_likes', function (Blueprint $table) {
                $table->id();
                $table->string('post_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('post_comment_likes')) {
            Schema::create('post_comment_likes', function (Blueprint $table) {
                $table->id();
                $table->string('post_comment_id');
                $table->foreignId('user_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('post_comment_replies')) {
            Schema::create('post_comment_replies', function (Blueprint $table) {
                $table->id();
                $table->string('post_comment_id');
                $table->foreignId('user');
                $table->text('content');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('friends')) {
            Schema::create('friends', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('friend_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('friend_requests')) {
            Schema::create('friend_requests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('friend_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('blocked_users')) {
            Schema::create('blocked_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('blocked_user_id');
                $table->text('reason')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('languages')) {
            Schema::create('languages', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->foreignId('language_type_id');
            });
        }

        if (!Schema::hasTable('language_types')) {
            Schema::create('language_types', function (Blueprint $table) {
                $table->id();
                $table->string('code');
                $table->string('name');
            });
        }

        if (!Schema::hasTable('followers')) {
            Schema::create('followers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('follower_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('sexuality_types')) {
            Schema::create('sexuality_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
        }

        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('country_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('profile_comment_likes')) {
            Schema::create('profile_comment_likes', function (Blueprint $table) {
                $table->id();
                $table->string('profile_comment_id');
                $table->foreignId('user');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('genders');
        Schema::dropIfExists('sexes');
        Schema::dropIfExists('user_filters');
        Schema::dropIfExists('interests');
        Schema::dropIfExists('interest_types');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('post_reactions');
        Schema::dropIfExists('post_comment_reactions');
        Schema::dropIfExists('friends');
        Schema::dropIfExists('friend_requests');
        Schema::dropIfExists('blocked_users');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('followers');
        Schema::dropIfExists('sexuality_types');
        Schema::dropIfExists('profile_comment_likes');
    }
};

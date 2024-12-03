<?php

namespace Database\Seeders;

use App\Facades\ElasticSearchServiceFacade;
use App\Models\AppLog;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Asset;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentLike;
use App\Models\Settings;
use App\Models\Sex;
use App\Models\User\Follower;
use App\Models\User\Friend;
use App\Models\User\FriendRequest;
use App\Models\User\Interest;
use App\Models\User\InterestType;
use App\Models\User\Language;
use App\Models\User\LanguageType;
use App\Models\User\ProfileComment;
use App\Models\User\ProfileCommentLike;
use App\Models\User\SexualityType;
use App\Models\User\User;
use App\Models\User\UserProfile;
use App\Models\User\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ElasticSearchServiceFacade::updateClusterSettings();
        ElasticSearchServiceFacade::deleteIndex('assets-*');
        ElasticSearchServiceFacade::deleteIndex('app-logs-*');

        $this->resetS3(['post-images', 'post-audios', 'profile-pictures']);

        $cities = json_decode(File::get(database_path('data/' . env('CITIES_JSON'))), true);
        $chunkSize = 1000;
        $citiesChunks = array_chunk($cities, $chunkSize);

        foreach ($citiesChunks as $chunk) {
            DB::table('cities')->insert($chunk);
        }

        $languages = json_decode(File::get(database_path('data/languages.json')), true);
        foreach ($languages as $language) {
            LanguageType::create([
                'name' => $language['name'],
                'code' => $language['code']
            ]);
        }

        $countries = json_decode(File::get(database_path('data/' . env('COUNTRIES_JSON'))), true);
        foreach ($countries as $country) {
            Country::create([
                'id' => $country['id'],
                'name' => $country['name'],
                'code' => $country['code']
            ]);
        }

        $genders = json_decode(File::get(database_path('data/genders.json')), true);
        foreach ($genders as $gender) {
            Gender::create([
                'name' => $gender['name']
            ]);
        }

        $sexes = json_decode(File::get(database_path('data/sexes.json')), true);
        foreach ($sexes as $sex) {
            Sex::create([
                'name' => $sex['name'],
                'code' => $sex['code']
            ]);
        }

        $interests = json_decode(File::get(database_path('data/interests.json')), true);
        foreach ($interests as $interest) {
            InterestType::create([
                'name' => $interest['name']
            ]);
        }

        $sexualities = json_decode(File::get(database_path('data/sexualities.json')), true);
        foreach ($sexualities as $sexuality) {
            SexualityType::create([
                'name' => $sexuality['name']
            ]);
        }

        $exampleUser = User::factory()
            ->has(Interest::factory()->count(3))
            ->has(Language::factory()->count(3))
            ->has(UserSetting::factory()->count(1)->state(['render_media' => false]), 'settings')
            ->has(UserProfile::factory()->count(1), 'profile')
            ->has(Asset::factory()->profile_picture()->count(1), 'profile_picture')
            ->create();

        $normalUser = User::factory()
            ->has(Interest::factory()->count(3))
            ->has(Language::factory()->count(3))
            ->has(UserSetting::factory()->count(1)->state(['render_media' => false]), 'settings')
            ->has(UserProfile::factory()->count(1), 'profile')
            ->has(Asset::factory()->profile_picture()->count(1), 'profile_picture')
            ->create([
                'email' => 'test2@test.com',
                'password' => bcrypt('&BrefT2D3UopN$s$'),
                'country' => 235
            ]);

        $adminUser = User::factory()
            ->has(Friend::factory()->state(['friend_id' => $exampleUser->first()->id])->count(1))
            ->has(FriendRequest::factory()->state(['friend_id' => $normalUser->first()->id])->count(1), 'friend_requests')
            ->has(Interest::factory()->count(3))
            ->has(Language::factory()->count(3))
            ->has(Follower::factory()->state(['follower_id' => $normalUser->first()->id])->count(1), 'followers')
            ->has(UserSetting::factory()->count(1)->state(['render_media' => true]), 'settings')
            ->has(UserProfile::factory()->count(1), 'profile')
            ->has(Asset::factory()->profile_picture()->count(1), 'profile_picture')
            ->has(AppLog::factory()->state(['profile' => $normalUser->id])->count(10), 'logs')
            ->has(AppLog::factory()->state(['profile' => $exampleUser->id])->count(10), 'logs')
            ->has(
                ProfileComment::factory()
                    ->has(
                        ProfileCommentLike::factory()->count(1), 'likes'
                    )->count(1),
                'comments'
            )
            ->create([
                'email' => 'test@test.com',
                'password' => bcrypt('&BrefT2D3UopN$s$'),
                'country' => 235
            ]);

        $posts = Post::factory()
            ->count(1)
            ->has(
                PostComment::factory()
                    ->has(PostCommentLike::factory()->count(1), 'likes')
                    ->count(1)
                , 'comments')
            ->has(Asset::factory()->post_image()->count(1), 'image_assets')
            ->create();

        Settings::create([
            'minimum_age' => 10,
            'maximum_age' => 120
        ]);
    }

    /**
     * @param array $disks
     * @return void
     */
    public function resetS3(array $disks): void
    {
        foreach ($disks as $disk) {
            $files = Storage::disk($disk)->allFiles();

            foreach ($files as $file) {
                Storage::disk($disk)->delete($file);
            }
        }
    }
}

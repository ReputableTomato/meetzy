<?php

namespace App\Models\User;

use App\Models\AppLog;
use App\Models\Asset;
use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Posts\Post;
use App\Models\Sex;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PDPhilip\Elasticsearch\Eloquent\HybridRelations;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HybridRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'country',
        'city',
        'date_of_birth',
        'sex',
        'gender',
        'status',
        'description',
        'interests',
        'password',
        'last_registration_email_sent_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'email',
        'role',
        'registered',
        'password_reset_token',
        'token',
        'password_reset_at',
        'last_registration_email_sent_at',
        'email_verified_at',
        'created_at',
        'updated_at',
        'last_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    public $with = ['country', 'city', 'gender', 'sex', 'interests', 'languages', 'sexuality', 'settings', 'profile', 'profile_picture'];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'age',
        'friend_count',
        'follower_count'
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    /**
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city');
    }

    /**
     * @return HasOne
     */
    public function filters(): HasOne
    {
        return $this->hasOne(UserFilter::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(InterestType::class, 'interests', 'user', 'interest_type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(LanguageType::class, 'languages', 'user_id', 'language_type_id');
    }

    /**
     * @return int
     */
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    /**
     * @return HasOne
     */
    public function profile_picture(): HasOne
    {
        return $this->hasOne(Asset::class, 'user')->where('type', Asset::PROFILE_PICTURE);
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user', 'id');
    }

    /**
     * @return \PDPhilip\Elasticsearch\Relations\HasOne
     */
    public function profile(): \PDPhilip\Elasticsearch\Relations\HasOne
    {
        return $this->hasOne(UserProfile::class, 'user', 'id');
    }

    /**
     * @return HasMany
     */
    public function friends(): HasMany
    {
        return $this->hasMany(Friend::class, 'user_id', 'id');
    }

    /**
     * @return int
     */
    public function getFriendCountAttribute(): int
    {
        return $this->friends()->count();
    }

    /**
     * @return HasMany
     */
    public function friend_requests(): HasMany
    {
        return $this->hasMany(FriendRequest::class, 'user_id', 'id');
    }

    /**
     * @return int
     */
    public function getFriendRequestCountAttribute(): int
    {
        return $this->friend_requests()->count();
    }

    /**
     * @return HasOne
     */
    public function gender(): HasOne
    {
        return $this->hasOne(Gender::class, 'id', 'gender');
    }

    /**
     * @return HasOne
     */
    public function sex(): HasOne
    {
        return $this->hasOne(Sex::class, 'id', 'sex');
    }

    /**
     * @return HasOne
     */
    public function sexuality(): HasOne
    {
        return $this->hasOne(SexualityType::class, 'id', 'sexuality');
    }

    /**
     * @return int
     */
    public function getFollowerCountAttribute(): int
    {
        return $this->followers()->count();
    }

    /**
     * @return HasMany
     */
    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class, 'user_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function settings(): HasOne
    {
        return $this->hasOne(UserSetting::class, 'user', 'id');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ProfileComment::class, 'user', 'id');
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(AppLog::class, 'user', 'id');
    }
}

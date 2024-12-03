<?php

namespace App\Models\Posts;

use App\Models\Asset;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PDPhilip\Elasticsearch\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'elasticsearch';

    protected $index = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user',
        'content',
        'hashtags',
        'mentions'
    ];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'comment_count',
        'created_at_title',
        'created_at_display',
        'like_count',
        'liked_by_user',
    ];

    /**
     * @var string[] $with
     */
    protected $with = [
        'user',
        'image_assets',
        'audio_assets'
    ];

    /**
     * @var string[] $hidden
     */
    protected $hidden = [
        'pivot'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * @return string
     */
    public function getCreatedAtTitleAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y H:i');
    }

    /**
     * @return string
     */
    public function getCreatedAtDisplayAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'post_id')->orderBy('created_at', 'desc');
    }

    /**
     * @return int
     */
    public function getCommentCountAttribute(): int
    {
        return $this->comments()->count();
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }

    /**
     * @return int
     */
    public function getLikeCountAttribute(): int
    {
        return $this->likes()->count();
    }

    /**
     * @return bool
     */
    public function getLikedByUserAttribute(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    /**
     * @return HasMany
     */
    public function image_assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'post_id')->where('type', Asset::POST_IMAGE);
    }

    /**
     * @return HasMany
     */
    public function audio_assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'post_id')->where('type', Asset::POST_AUDIO);
    }
}

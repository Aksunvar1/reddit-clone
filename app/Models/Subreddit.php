<?php

namespace App\Models;

use App\Helpers\Enums\SubredditStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subreddit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'url',
        'logo',
        'title',
        'status',
    ];

    protected $casts = [
        'name' => 'string',
        'url' => 'string',
        'logo' => 'string',
        'title' => 'string',
        'status' => SubredditStatusEnum::class,
    ];

    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'subreddit_members');
    }

    public function moderators(): HasMany
    {
        return $this->hasMany(User::class, 'subreddit_moderators');
    }
}

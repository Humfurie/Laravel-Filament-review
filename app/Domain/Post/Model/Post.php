<?php

namespace App\Domain\Post\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'category_id',
        'content',
        'published_date',
        'tags',
        'image',
        'google_drive_url'
    ];

    protected $casts = [
        'published_date' => 'datetime',
        'tags' => 'json'
    ];
}

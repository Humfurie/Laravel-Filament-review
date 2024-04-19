<?php

namespace App\Domain\Post\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'category_id',
        'published_date',
        'tags',
        'image',
        'google_drive_url'
    ];

    protected $casts = [
      'published_date' => 'datetime'
    ];
}

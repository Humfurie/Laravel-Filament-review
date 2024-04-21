<?php

namespace App\Domain\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property bool $is_visible
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_visible'
    ];

    protected $casts = [
      'is_visible' => 'bool'
    ];
}

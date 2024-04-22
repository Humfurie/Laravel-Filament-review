<?php

namespace App\Domain\Category\Models;

use App\Domain\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_visible'
    ];

    protected $casts = [
        'is_visible' => 'bool'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

<?php

namespace App\Domain\Post\Models;

use App\Domain\Category\Models\Category;
use App\Domain\User\Models\User;
use DateTime;
use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $category_id
 * @property string $content
 * @property DateTime $published_date
 * @property string $tags
 * @property string $image
 *
 * @method static create(array $array)
 */

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
    ];

    protected $casts = [
        'published_date' => 'datetime',
        'tags' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

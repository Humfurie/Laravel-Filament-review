<?php

namespace App\Domain\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool Returns true if the user is an admin, false otherwise.
     */
    public function isAdmin(): bool
    {
        return $this->id === 1;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

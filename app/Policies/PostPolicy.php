<?php

namespace App\Policies;

use App\Domain\Post\Models\Post;
use App\Domain\User\Models\User;
use App\Traits\WildCardPermissions;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use WildCardPermissions;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
         return $this->hasWildCardPermission($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return $this->hasWildCardPermission($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasWildCardPermission($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $this->hasWildCardPermission($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $this->hasWildCardPermission($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $this->hasWildCardPermission($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $this->hasWildCardPermission($user);
    }
}

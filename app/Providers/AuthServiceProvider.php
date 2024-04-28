<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Domain\Post\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') || $user->isAdmin() ? true : null;
        });
    }
}

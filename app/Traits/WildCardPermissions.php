<?php

namespace App\Traits;

use App\Domain\User\Models\User;
use Illuminate\Support\Str;

trait WildCardPermissions
{
    protected function hasWildCardPermission(User $user): bool
    {
        return $user->can($this->getAbility());
    }

    private function getAbility(): string
    {
        $resource = Str::of(static::class)->classBasename()->remove('Policy')->camel();

        $ability = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3)[2]['function'];

        if (is_string($ability)) {
            return "{$resource}.{$ability}";
        }

        throw new \RuntimeException('Unable to determine resource ability.');
    }
}

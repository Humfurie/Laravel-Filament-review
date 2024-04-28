<?php

namespace App\Domain\Permission\database\factories;

use App\Domain\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PermissionFactory extends Factory
{
    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<Permission>
     */

    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public
    function definition(): array
    {
        return [
            'name' => Str::lower(fake()->word)
        ];
    }
}

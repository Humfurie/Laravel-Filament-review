<?php

namespace App\Domain\User\database\seeders;

use App\Domain\User\database\factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => "password"
        ])->createOne();
    }
}

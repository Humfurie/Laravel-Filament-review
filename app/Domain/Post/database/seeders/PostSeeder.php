<?php

namespace App\Domain\Post\database\seeders;

use App\Domain\Post\database\factories\PostFactory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostFactory::new()->count(10)->create();
    }
}

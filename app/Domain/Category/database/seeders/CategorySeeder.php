<?php

namespace App\Domain\Category\database\seeders;

use App\Domain\Category\database\factories\CategoryFactory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryFactory::new()->count(5)->create();
    }
}

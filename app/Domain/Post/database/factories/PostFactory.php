<?php

namespace App\Domain\Post\database\factories;

use App\Domain\Category\Model\Category;
use App\Domain\Post\Model\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->title;
        return [
            'user_id' => auth()->user(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence,
            'category_id' => Category::query()->inRandomOrder()->first(),
            'content' => "<p>this is a test</p>",
            'published_date' => now(),
            'tags' => [fake()->word],
            'image' => fake()->word,
            'google_drive_url' => fake()->url
        ];
    }
}

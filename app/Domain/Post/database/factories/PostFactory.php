<?php

namespace App\Domain\Post\database\factories;

use App\Domain\Category\Models\Category;
use App\Domain\Post\Enums\Status;
use App\Domain\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
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
            'status' => Arr::random(Status::class),
            'image' => fake()->word,
        ];
    }
}

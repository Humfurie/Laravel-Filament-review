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
        $status = Arr::random(Status::cases());
        return [
            'user_id' => auth()->user()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence,
            'category_id' => Category::query()->inRandomOrder()->first(),
            'content' => "<p>this is a test</p>",
            'tags' => [fake()->word],
            'status' => $status,
            'published_date' => $status === Status::ACTIVE->value ? now() : null,
            'image' => fake()->word,
        ];
    }
}

<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Domain\Post\Models\Post;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            return Post::create([
                'user_id' => auth()->user()->id ?? 1,
                'title' => $data['title'],
                'slug' => $data['slug'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'content' => $data['content'],
                'published_date' => $data['published_date'],
                'tags' => $data['tags'],
                'image' => $data['image'],
            ]);
        });
    }
}

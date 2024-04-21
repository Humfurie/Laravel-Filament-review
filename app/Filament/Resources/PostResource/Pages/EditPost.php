<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Domain\Post\Models\Post;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
             $record->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'content' => $data['content'],
                'published_date' => $data['published_date'],
                'tags' => $data['tags'],
                'image' => $data['image'],
            ]);

            return $record;
        });
    }
}

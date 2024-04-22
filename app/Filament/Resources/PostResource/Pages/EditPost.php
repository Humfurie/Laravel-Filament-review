<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Domain\Post\Enums\Status;
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
                 'user_id' => auth()->user()->id ?? 1,
                 'title' => $data['title'],
                 'description' => $data['description'],
                 'category_id' => $data['category_id'],
                 'content' => $data['content'],
                 'tags' => $data['tags'],
                 'status' => $data['status'] ?? Status::INACTIVE,
                 'image' => $data['image'],
                 'published_date' => $data['status'] === Status::ACTIVE ? $data['published_date'] : null,
            ]);

            return $record;
        });
    }
}

<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Domain\Permission\Enums\PermissionEnum;
use App\Domain\Permission\Models\Permission;
use App\Filament\Resources\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $abilities = PermissionEnum::cases();
        return DB::transaction(function () use ($data, $abilities) {
            foreach ($abilities as $ability) {
                 Permission::create([
                    'name' => Str::lower($data['model']).'.'.$ability->value
                ]);
            }
            return Permission::latest()->first();
        });
    }

    protected function getRedirectUrl(): string
    {
        return self::getResource()::getUrl('index');
    }
}

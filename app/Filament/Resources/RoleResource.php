<?php

namespace App\Filament\Resources;

use App\Domain\Permission\Models\Permission;
use App\Domain\Role\Models\Role;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $permissionsByType = [];

        foreach (Permission::query()->pluck('name', 'id') as $permissions) {

            list($type, $action) = explode('.', $permissions, 2);

            if (!isset($permissionsByType[$type])) {
                $permissionsByType[$type] = [];
            }

            $permissionsByType[$type][] = $permissions;
        }
        $checkboxListSchema = [];

        foreach ($permissionsByType as $key => $permission) {
            $checkboxListSchema[] = Section::make($key)
                ->schema([
                    CheckboxList::make($key)
                        ->options($permission)
                ])
                ->collapsible()
                ->collapsed();
        }

        return $form
            ->schema([
                TextInput::make('name'),
                Section::make()
                    ->schema([
                        Repeater::make('permissions')
                            ->schema($checkboxListSchema)
                            ->addable(false)
                            ->deletable(false)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}

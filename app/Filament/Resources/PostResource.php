<?php

namespace App\Filament\Resources;

use App\Domain\Category\Models\Category;
use App\Domain\Post\Models\Post;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->lazy()
                            ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->visibleOn('create'),
                        Forms\Components\Textarea::make('description'),
                        Forms\Components\Select::make('category_id')
                            ->options(Category::query()->where('is_visible', true)->pluck('name', 'id')),
                        Forms\Components\RichEditor::make('content'),
                        Forms\Components\DateTimePicker::make('published_date')
                            ->nullable(),
                        Forms\Components\TagsInput::make('tags')->nullable(),
                        Forms\Components\FileUpload::make('image')->nullable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
//                Tables\Columns\TextColumn::make('category_id')->formatStateUsing(fn($record) => dd($record->category()->name)),
                Tables\Columns\TextColumn::make('published_date')
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

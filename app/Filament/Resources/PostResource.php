<?php

namespace App\Filament\Resources;

use App\Domain\Category\Models\Category;
use App\Domain\Post\Enums\Status;
use App\Domain\Post\Models\Post;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                            ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->visibleOn('create'),
                        Forms\Components\Textarea::make('description'),
                        Forms\Components\Select::make('category_id')
                            ->options(Category::query()->where('is_visible', true)->pluck('name', 'id'))
                            ->required(),
                        Forms\Components\RichEditor::make('content'),
                        Forms\Components\TagsInput::make('tags')->nullable(),
                        Forms\Components\Select::make('status')
                            ->live()
                            ->options(Status::class)
                            ->default(Status::INACTIVE->value)
                            ->required()
                            ->selectablePlaceholder(false),
                        Forms\Components\DateTimePicker::make('published_date')
                            ->live()
                            ->visible(fn(Forms\Get $get): bool => $get('status') === Status::ACTIVE->value)
                            ->required(),
                        Forms\Components\FileUpload::make('image')
                            ->directory('posts')
                            ->nullable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
//                Tables\Columns\TextColumn::make('category_id')->formatStateUsing(fn($record) => dd($record->category()->name)),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Status::class),
                Tables\Filters\TrashedFilter::make('trashed')
                    ->placeholder('Without trashed records')
                    ->trueLabel('With trashed records')
                    ->falseLabel('Only trashed records')
                    ->queries(
                        true: fn(Builder $query) => $query->withTrashed(),
                        false: fn(Builder $query) => $query->onlyTrashed(),
                        blank: fn(Builder $query) => $query->withoutTrashed(),
                    )
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
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

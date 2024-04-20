<?php

use function Pest\Livewire\livewire;

/**
 * It can render page
 * It can list posts
 * It can create posts
 * It can update posts
 * It can delete posts
 * It can filter posts
 * It can restore deleted posts
 *
 */


it('can render list page', function () {
    livewire(\App\Filament\Resources\PostResource\Pages\ListPosts::class)
        ->assertOk();
});

it('can render create page', function () {
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->assertFormExists()
        ->assertOk();
});

it('can render edit page', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();
    $post = \App\Domain\Post\database\factories\PostFactory::new([
        'user_id' => 1,
        'category_id' => (int)$category->id
    ])
        ->createOne();

    livewire(\App\Filament\Resources\PostResource\Pages\EditPost::class, ['record' => $post->id])
        ->assertFormExists()
        ->assertOk();
});

it('can list posts', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();
    $posts = \App\Domain\Post\database\factories\PostFactory::new([
        'user_id' => 1,
        'category_id' => (int)$category->id
    ])
        ->count(10)
        ->create();

    livewire(\App\Filament\Resources\PostResource\Pages\ListPosts::class)
        ->assertCanSeeTableRecords($posts)
        ->assertOk();
});

it('can create posts', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();
    $title = 'First Post';
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'title' => $title,
            'description' => 'tis is description',
            'category_id' => $category->id,
            'content' => "<p>humps what are you doing</p>",
            'published_date' => now(),
            'tags' => ['one', 'two'],
            'image' => ["humps.png"],
        ])
        ->assertFormSet([
            'slug' => \Illuminate\Support\Str::slug($title),
        ])
        ->call('create')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;
});

it('can update posts', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();
    $post = \App\Domain\Post\database\factories\PostFactory::new([
        'user_id' => 1,
        'category_id' => (int)$category->id
    ])->createOne();
    $title = 'Second Post';
    livewire(\App\Filament\Resources\PostResource\Pages\EditPost::class, ['record' => $post->getRouteKey()])
        ->fillForm([
            'title' => $title,
            'description' => 'tis is description',
            'category_id' => $category->id,
            'content' => "<p>humps what are you doing</p>",
            'published_date' => now(),
            'tags' => ['one', 'two'],
            'image' => ["humps.png"],
        ])
        ->call('save')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;
});

it('can delete posts', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();
    $post = \App\Domain\Post\database\factories\PostFactory::new([
        'user_id' => 1,
        'category_id' => (int)$category->id
    ])->createOne();

    livewire(\App\Filament\Resources\PostResource\Pages\ListPosts::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $post)
        ->assertOk();
});

it('can restore posts', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();
    $post = \App\Domain\Post\database\factories\PostFactory::new([
        'user_id' => 1,
        'category_id' => (int)$category->id
    ])
        ->trashed()
        ->createOne();

    livewire(\App\Filament\Resources\PostResource\Pages\ListPosts::class)
        ->callTableAction(\Filament\Actions\RestoreAction::class, $post)
        ->assertOk();
});

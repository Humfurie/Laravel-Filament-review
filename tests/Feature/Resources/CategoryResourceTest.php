<?php

use function Pest\Livewire\livewire;

beforeEach(function () {
   $this->actingAs(\App\Domain\User\database\factories\UserFactory::new()->createOne());
});

it('can render list page', function () {
    livewire(\App\Filament\Resources\CategoryResource\Pages\ListCategories::class)
        ->assertOk();
});

it('can render create page', function () {
    livewire(\App\Filament\Resources\CategoryResource\Pages\CreateCategory::class)
    ->assertFormExists()
    ->assertOk();
});

it('can render edit page', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();

    livewire(\App\Filament\Resources\CategoryResource\Pages\EditCategory::class, ['record' => $category->getRouteKey()])
    ->assertFormExists()
    ->assertOk();

});

it('can list category', function () {
    $categories = \App\Domain\Category\database\factories\CategoryFactory::new()
        ->count(10)
        ->create();

    livewire(\App\Filament\Resources\CategoryResource\Pages\ListCategories::class)
        ->assertCanSeeTableRecords($categories)
        ->assertOk();
});

it('can create category', function () {
    $name = 'Adventure';

    $data = [
        'name' => $name,
        'description' => 'This is description',
        'is_visible' => \Illuminate\Support\Arr::random([true, false])
    ];

    livewire(\App\Filament\Resources\CategoryResource\Pages\CreateCategory::class)
        ->fillForm($data)
        ->assertFormSet([
            'slug' => \Illuminate\Support\Str::slug($name),
        ])
        ->call('create')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;

    $this->assertDatabaseHas('categories', $data);
});

it('can update category', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();

    $name = 'Adventure';

    $data = [
        'name' => $name,
        'description' => 'This is description',
        'is_visible' => \Illuminate\Support\Arr::random([true, false])
    ];

    livewire(\App\Filament\Resources\CategoryResource\Pages\EditCategory::class, ['record' => $category->getRouteKey()])
        ->fillForm($data)
        ->call('save')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;

    $this->assertDatabaseHas('categories', $data);
});

it('can delete category', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->createOne();

    livewire(\App\Filament\Resources\CategoryResource\Pages\ListCategories::class)
    ->callTableAction(\Filament\Actions\DeleteAction::class, $category)
    ->assertOk();
});

it('can restore category', function () {
    $category = \App\Domain\Category\database\factories\CategoryFactory::new()->trashed()->createOne();

    livewire(\App\Filament\Resources\CategoryResource\Pages\ListCategories::class)
        ->callTableAction(\Filament\Actions\RestoreAction::class, $category)
        ->assertOk();
});

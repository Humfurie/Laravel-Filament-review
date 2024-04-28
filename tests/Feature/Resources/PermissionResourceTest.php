<?php

use Illuminate\Support\Str;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->actingAs(\App\Domain\User\database\factories\UserFactory::new()->createOne());
});

it('can render list page', function () {
    livewire(\App\Filament\Resources\PermissionResource\Pages\ListPermissions::class)
        ->assertOk();
});

it('can render create page', function () {
    livewire(\App\Filament\Resources\PermissionResource\Pages\CreatePermission::class)
        ->assertFormExists()
        ->assertOk();
});

it('can render edit page', function () {
    $permission = \App\Domain\Permission\database\factories\PermissionFactory::new()->createOne();

    livewire(\App\Filament\Resources\PermissionResource\Pages\EditPermission::class, ['record' => $permission->getRouteKey()])
        ->assertFormExists()
        ->assertOk();
});

it('can create permission', function () {
    $data = [
        'model' => \Illuminate\Support\Str::lower(fake()->word)
    ];

    livewire(\App\Filament\Resources\PermissionResource\Pages\CreatePermission::class)
        ->fillForm($data)
        ->call('create')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;

    $abilities = \App\Domain\Permission\Enums\PermissionEnum::cases();

    foreach ($abilities as $ability) {
        $this->assertDatabaseHas('permissions', ['name' => Str::lower($data['model']) . '.' . $ability->value]);
    }
});

it('can update permission', function () {
    $permission = \App\Domain\Permission\database\factories\PermissionFactory::new()->createOne();

    $data = [
        'name' => 'post.view'
    ];

    livewire(\App\Filament\Resources\PermissionResource\Pages\EditPermission::class, ['record' => $permission->getRouteKey()])
        ->fillForm($data)
        ->call('save')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;

    $this->assertDatabaseHas('permissions', $data);
});

it('can delete permissions', function () {
    $permission = \App\Domain\Permission\database\factories\PermissionFactory::new()->createOne();

    livewire(\App\Filament\Resources\PermissionResource\Pages\ListPermissions::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $permission)
        ->assertOk();
});



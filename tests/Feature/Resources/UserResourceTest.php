<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->actingAs(\App\Domain\User\database\factories\UserFactory::new()->createOne());
});

it('can render list page', function () {
    livewire(\App\Filament\Resources\UserResource\Pages\ListUsers::class)
        ->assertOk();
});

it('can render create page', function () {
    livewire(\App\Filament\Resources\UserResource\Pages\CreateUser::class)
        ->assertFormExists()
        ->assertOk();
});

it('can render edit page', function () {
    $user = \App\Domain\User\database\factories\UserFactory::new()->createOne();

    livewire(\App\Filament\Resources\UserResource\Pages\EditUser::class, ['record' => $user->getRouteKey()])
        ->assertFormExists()
        ->assertOk();
});


it('can create users', function () {

    $data = [
        'name' => fake()->name(),
        'email' => fake()->unique()->email,
        'password' => Hash::make('password'),
    ];

    livewire(\App\Filament\Resources\UserResource\Pages\CreateUser::class)
        ->fillForm($data)
        ->call('create')
        ->assertHasNoFormErrors()
        ->instance()
        ->record;

    $this->assertDatabaseHas('users', $data);
});

//it('cannot delete first user', function () {
//    $user = \App\Domain\User\Models\User::query()->whereId(1)->get();
//
//    livewire(\App\Filament\Resources\UserResource\Pages\ListUsers::class)
//    ->callTableAction(\Filament\Tables\Actions\DeleteAction::class, $user)
//    ->assertBadRequest();
//});


//it('can render users page', function () {
//});
//
//it('can render users page', function () {
//});

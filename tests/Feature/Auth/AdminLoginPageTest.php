<?php

use App\Domain\User\database\factories\UserFactory;
use function Pest\Livewire\livewire;

//beforeEach(function () {
//});

it('can render login page', function () {
    livewire(\App\Filament\Pages\Auth\LoginPage::class)->assertSuccessful();
});

it('can authenticate users', function () {

    $user = UserFactory::new([
        'email' => 'admin@admin.com',
        'password' => 'password'
    ])->createOne();

    livewire(\App\Filament\Pages\Auth\LoginPage::class)
        ->fillForm([
            'data.email' => $user->email,
            'data.password' => $user->password
        ])
        ->call('authenticate')
        ->assertSuccessful();
})->only();

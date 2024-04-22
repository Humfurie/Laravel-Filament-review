<?php

use App\Domain\User\database\factories\UserFactory;

use function Pest\Livewire\livewire;

//beforeEach(function () {
//});

it('can render login page', function () {

    livewire(\App\Filament\Pages\Auth\LoginPage::class)->assertSuccessful();
});

//it('can authenticate users', function () {
//    $user = UserFactory::new()->createOne();
//    livewire(Login::class)
//        ->fill([
//            'data.email' => $user->email,
//            'data.password' => $user->password
//        ])
//        ->call('authenticate')
//        ->assertHasNoFormErrors()
//    ->errors();
//
//    expect(\Illuminate\Support\Facades\Auth::check())->toBeTrue();
//});

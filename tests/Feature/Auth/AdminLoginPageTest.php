<?php

use Filament\Pages\Auth\Login;
use App\Domain\User\database\factories\UserFactory;

use function Pest\Livewire\livewire;

it('can render login page', function () {
    livewire(Login::class)->assertOk();
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

<?php

use function \Pest\Livewire\livewire;

it('can list posts', function () {
    $posts = \App\Domain\Post\Model\Post::factory()->count(10)->create();

    livewire(\App\Filament\Resources\PostResource\Pages\ListPosts::class)
        ->assertCanSeeTableRecords($posts);
})->only();

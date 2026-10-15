<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('user profile id is generated in the required format', function () {
    $user = User::factory()->create();

    expect($user->profile_id)->toMatch('/^[A-Z0-9]{4}-\d{6}$/');
    $this->assertDatabaseHas('users', ['id' => $user->id, 'profile_id' => $user->profile_id]);
});

test('user profile ids are unique', function () {
    $first = User::factory()->create();
    $second = User::factory()->create();

    expect($first->profile_id)->not->toBe($second->profile_id);
});

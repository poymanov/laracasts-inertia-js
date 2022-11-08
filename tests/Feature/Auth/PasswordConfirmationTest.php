<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(routeBuilderHelper()->common->confirmPassword());

    $response->assertOk();
});

test('password can be confirmed', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(routeBuilderHelper()->common->confirmPassword(), [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(routeBuilderHelper()->common->confirmPassword(), [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});

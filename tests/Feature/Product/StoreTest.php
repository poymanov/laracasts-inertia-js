<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Faker\faker;

uses(RefreshDatabase::class);

test('redirect guest to login', function () {
    $this->followingRedirects();

    $response = $this->post(routeBuilderHelper()->product->store());

    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('validation failed: empty name', function () {
    authHelper()->signIn();

    $response = $this->post(routeBuilderHelper()->product->store());

    $response->assertSessionHasErrors(['name']);
});

test('validation failed: too long name', function () {
    authHelper()->signIn();

    $response = $this->post(routeBuilderHelper()->product->store(), ['name' => faker()->realTextBetween(256, 300)]);

    $response->assertSessionHasErrors(['name']);
});

test('success', function () {
    authHelper()->signIn();

    $name = faker()->text();

    $response = $this->post(routeBuilderHelper()->product->store(), ['name' => $name]);
    $response->assertSessionHasNoErrors();
    $response->assertRedirect('/products');

    $this->assertDatabaseHas('products', ['name' => $name]);
});

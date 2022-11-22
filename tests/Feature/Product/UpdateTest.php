<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Faker\faker;

uses(RefreshDatabase::class);

test('redirect guest to login', function () {
    $this->followingRedirects();

    $product = modelBuilderHelper()->product->create();

    $response = $this->patch(routeBuilderHelper()->product->update($product->id));

    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('not existed', function () {
    authHelper()->signIn();

    $response = $this->get(routeBuilderHelper()->product->update(faker()->uuid), ['name' => faker()->word]);

    $response->assertNotFound();
});

test('wrong id', function () {
    authHelper()->signIn();

    $response = $this->get(routeBuilderHelper()->product->update('123'), ['name' => faker()->word]);

    $response->assertRedirect(routeBuilderHelper()->common->dashboard());
});

test('validation failed: empty name', function () {
    authHelper()->signIn();

    $product = modelBuilderHelper()->product->create();

    $response = $this->patch(routeBuilderHelper()->product->update($product->id));

    $response->assertSessionHasErrors(['name']);
});

test('validation failed: too long name', function () {
    authHelper()->signIn();

    $product = modelBuilderHelper()->product->create();

    $response = $this->patch(
        routeBuilderHelper()->product->update(
            $product->id
        ),
        ['name' => faker()->realTextBetween(256, 300)]
    );

    $response->assertSessionHasErrors(['name']);
});

test('success', function () {
    authHelper()->signIn();

    $name = faker()->text();

    $product = modelBuilderHelper()->product->create();

    $response = $this->patch(routeBuilderHelper()->product->update($product->id), ['name' => $name]);
    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(routeBuilderHelper()->product->index())
        ->assertSessionHas('success', 'Product updated.');

    $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => $name]);
});

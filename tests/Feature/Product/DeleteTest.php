<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Faker\faker;

uses(RefreshDatabase::class);

test('redirect guest to login', function () {
    $this->followingRedirects();

    $product = modelBuilderHelper()->product->create();

    $response = $this->delete(routeBuilderHelper()->product->delete($product->id));

    $response->assertOk()->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('not found', function () {
    authHelper()->signIn();

    $response = $this->delete(routeBuilderHelper()->product->delete(faker()->uuid));

    $response->assertNotFound();
});

test('wrong id', function () {
    authHelper()->signIn();

    $response = $this->get(routeBuilderHelper()->product->delete('123'));

    $response->assertRedirect(routeBuilderHelper()->common->dashboard());
});

test('failed', function () {
    authHelper()->signIn();

    $product = modelBuilderHelper()->product->create();

    Product::deleting(fn () => false);

    $response = $this->delete(routeBuilderHelper()->product->delete($product->id));
    $response->assertSessionHas('alert.error', 'Failed to delete product: ' . $product->id);
});

test('success', function () {
    authHelper()->signIn();

    $product = modelBuilderHelper()->product->create();

    $response = $this->delete(routeBuilderHelper()->product->delete($product->id));
    $response
        ->assertRedirect(routeBuilderHelper()->product->index())
        ->assertSessionHas('success', 'Product deleted.');

    $this->assertDatabaseMissing('products', ['id' => $product->id, 'deleted_at' => null]);
});

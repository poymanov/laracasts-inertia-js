<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

test('redirect guest to login', function () {
    $this->followingRedirects();

    $response = $this->get(routeBuilderHelper()->product->index());

    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('page can be rendered', function () {
    authHelper()->signIn();
    $response = $this->get(routeBuilderHelper()->product->index());

    $response
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Product/Index'));
});

test('show products list', function () {
    $productOne = modelBuilderHelper()->product->create();
    $productTwo = modelBuilderHelper()->product->create();

    authHelper()->signIn();
    $response = $this->get(routeBuilderHelper()->product->index());

    $response
        ->assertInertia(fn (Assert $page) => $page->component('Product/Index')
            ->has('products.data', 2)
            ->has('products.data.0', fn (Assert $page) => $page->whereAll([
                'id'   => $productOne->id,
                'name' => $productOne->name,
            ]))
            ->has('products.data.1', fn (Assert $page) => $page->whereAll([
                'id'   => $productTwo->id,
                'name' => $productTwo->name,
            ]))
            ->has('products.links', 3));
});

test('show products list with pagination', function () {
    modelBuilderHelper()->product->create();
    modelBuilderHelper()->product->create();
    modelBuilderHelper()->product->create();

    authHelper()->signIn();
    $response = $this->get(routeBuilderHelper()->product->index());

    $response
        ->assertInertia(fn (Assert $page) => $page->component('Product/Index')
            ->has('products.data', 2)
            ->has('products.data.0')
            ->has('products.data.1')
            ->has('products.links', 4)
            ->missing('products.data.2'));
});

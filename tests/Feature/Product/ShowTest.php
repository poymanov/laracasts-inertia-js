<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

test('redirect guest to login', function () {
    $this->followingRedirects();

    $product = modelBuilderHelper()->product->create();

    $response = $this->get(routeBuilderHelper()->product->show($product->id));

    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('not existed', function () {
    authHelper()->signIn();

    $response = $this->get(routeBuilderHelper()->product->show('97b2449b-cc1a-4632-a1f6-463e2addae75'));

    $response->assertNotFound();
});

test('wrong id', function () {
    authHelper()->signIn();

    $response = $this->get(routeBuilderHelper()->product->show('123'));

    $response->assertRedirect(routeBuilderHelper()->common->dashboard());
});

test('show product info', function () {
    authHelper()->signIn();

    $product = modelBuilderHelper()->product->create();

    $response = $this->get(routeBuilderHelper()->product->show($product->id));

    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Product/Show')
            ->has('product', fn (Assert $page) => $page->whereAll([
                'id'   => $product->id,
                'name' => $product->name,
            ])));
});

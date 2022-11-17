<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

test('redirect guest to login', function () {
    $this->followingRedirects();

    $response = $this->get(routeBuilderHelper()->product->create());

    $response->assertStatus(200)
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('page can be rendered', function () {
    authHelper()->signIn();
    $response = $this->get(routeBuilderHelper()->product->create());

    $response
        ->assertStatus(200)
        ->assertInertia(fn (Assert $page) => $page->component('Product/Create'));
});

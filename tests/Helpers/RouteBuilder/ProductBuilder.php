<?php

namespace Tests\Helpers\RouteBuilder;

class ProductBuilder
{
    /**
     * @return string
     */
    public function index(): string
    {
        return '/products';
    }

    /**
     * @return string
     */
    public function create(): string
    {
        return '/products/create';
    }

    /**
     * @return string
     */
    public function store(): string
    {
        return '/products';
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public function show(string $id): string
    {
        return '/products/' . $id;
    }
}

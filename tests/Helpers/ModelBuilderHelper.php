<?php

namespace Tests\Helpers;

use Tests\Helpers\ModelBuilder\ProductBuilder;
use Tests\Helpers\ModelBuilder\UserBuilder;

class ModelBuilderHelper
{
    private static ?ModelBuilderHelper $instance = null;

    public ProductBuilder $product;

    public UserBuilder $user;

    private function __construct()
    {
        $this->product = new ProductBuilder();
        $this->user    = new UserBuilder();
    }

    /**
     * @return ModelBuilderHelper
     */
    public static function getInstance(): ModelBuilderHelper
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}

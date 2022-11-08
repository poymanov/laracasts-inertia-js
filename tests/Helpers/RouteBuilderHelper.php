<?php

namespace Tests\Helpers;

use Tests\Helpers\RouteBuilder\CommonBuilder;
use Tests\Helpers\RouteBuilder\ProductBuilder;

class RouteBuilderHelper
{
    private static ?RouteBuilderHelper $instance = null;

    public ProductBuilder $product;
    public CommonBuilder  $common;

    public function __construct()
    {
        $this->product = new ProductBuilder();
        $this->common  = new CommonBuilder();
    }

    public static function getInstance(): RouteBuilderHelper
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}

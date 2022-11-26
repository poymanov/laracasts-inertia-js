<?php

namespace App\Service\Product\Contracts;

use App\Models\Product;
use App\Service\Product\Dtos\ProductDto;

interface ProductDtoFactoryContract
{
    /**
     * @param Product $product
     *
     * @return ProductDto
     */
    public function createFromModel(Product $product): ProductDto;
}

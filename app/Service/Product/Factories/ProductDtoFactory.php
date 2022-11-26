<?php

namespace App\Service\Product\Factories;

use App\Models\Product;
use App\Service\Product\Contracts\ProductDtoFactoryContract;
use App\Service\Product\Dtos\ProductDto;

class ProductDtoFactory implements ProductDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromModel(Product $product): ProductDto
    {
        $dto       = new ProductDto();
        $dto->id   = $product->id;
        $dto->name = $product->name;

        return $dto;
    }
}

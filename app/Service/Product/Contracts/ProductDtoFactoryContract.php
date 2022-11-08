<?php

namespace App\Service\Product\Contracts;

use App\Models\Product;
use App\Service\Product\Dtos\ProductDto;
use Illuminate\Database\Eloquent\Collection;

interface ProductDtoFactoryContract
{
    /**
     * @param Product $product
     *
     * @return ProductDto
     */
    public function createFromModel(Product $product): ProductDto;

    /**
     * @param Collection<int, Product> $products
     *
     * @return ProductDto[]
     */
    public function createFromModels(Collection $products): array;
}

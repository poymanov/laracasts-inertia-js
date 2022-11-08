<?php

namespace App\Service\Product\Repositories;

use App\Models\Product;
use App\Service\Product\Contracts\ProductDtoFactoryContract;
use App\Service\Product\Contracts\ProductRepositoryContract;

class ProductRepository implements ProductRepositoryContract
{
    public function __construct(private readonly ProductDtoFactoryContract $productDtoFactory)
    {
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->productDtoFactory->createFromModels(Product::all());
    }
}

<?php

namespace App\Service\Product;

use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Contracts\ProductServiceContract;

class ProductService implements ProductServiceContract
{
    public function __construct(private readonly ProductRepositoryContract $productRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->productRepository->findAll();
    }
}

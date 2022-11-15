<?php

namespace App\Service\Product;

use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use App\Service\Product\Dtos\ProductFilterDto;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService implements ProductServiceContract
{
    public function __construct(private readonly ProductRepositoryContract $productRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function findAll(ProductFilterDto $filter): LengthAwarePaginator
    {
        return $this->productRepository->findAll($filter);
    }
}

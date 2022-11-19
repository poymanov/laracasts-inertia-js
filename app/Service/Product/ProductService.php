<?php

namespace App\Service\Product;

use App\Service\Product\Contracts\ProductCreateDtoFactoryContract;
use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService implements ProductServiceContract
{
    public function __construct(
        private readonly ProductRepositoryContract $productRepository,
        private readonly ProductCreateDtoFactoryContract $productCreateDtoFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function findOneById(string $id): ProductDto
    {
        return $this->productRepository->findOneById($id);
    }

    /**
     * @inheritDoc
     */
    public function findAll(ProductFilterDto $filter): LengthAwarePaginator
    {
        return $this->productRepository->findAll($filter);
    }

    /**
     * @inheritDoc
     */
    public function create(string $name): void
    {
        $productCreateDto = $this->productCreateDtoFactory->createFromParams($name);

        $this->productRepository->create($productCreateDto);
    }
}

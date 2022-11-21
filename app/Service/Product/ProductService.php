<?php

namespace App\Service\Product;

use App\Service\Product\Contracts\ProductCreateDtoFactoryContract;
use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use App\Service\Product\Contracts\ProductUpdateDtoFactoryContract;
use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService implements ProductServiceContract
{
    public function __construct(
        private readonly ProductRepositoryContract $productRepository,
        private readonly ProductCreateDtoFactoryContract $productCreateDtoFactory,
        private readonly ProductUpdateDtoFactoryContract $productUpdateDtoFactory
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

    /**
     * @inheritDoc
     */
    public function update(string $id, string $name): void
    {
        $productUpdateDto = $this->productUpdateDtoFactory->createFromParams($name);

        $this->productRepository->update($id, $productUpdateDto);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): void
    {
        $this->productRepository->delete($id);
    }
}

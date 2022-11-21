<?php

namespace App\Service\Product\Repositories;

use App\Models\Product;
use App\Service\Product\Contracts\ProductDtoFactoryContract;
use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Dtos\ProductCreateDto;
use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Dtos\ProductUpdateDto;
use App\Service\Product\Exceptions\ProductCreateException;
use App\Service\Product\Exceptions\ProductDeleteException;
use App\Service\Product\Exceptions\ProductNotFoundException;
use App\Service\Product\Exceptions\ProductUpdateException;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryContract
{
    public function __construct(private readonly ProductDtoFactoryContract $productDtoFactory)
    {
    }

    /**
     * Получение товара по ID
     *
     * @param string $id
     *
     * @return ProductDto
     * @throws ProductNotFoundException
     */
    public function findOneById(string $id): ProductDto
    {
        $product = $this->findOneModelById($id);

        return $this->productDtoFactory->createFromModel($product);
    }

    /**
     * @inheritDoc
     */
    public function findAll(ProductFilterDto $filter): LengthAwarePaginator
    {
        return Product::query()
            ->when($filter->name, function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->paginate($filter->paginationLimit)
            ->withQueryString()
            ->through(fn (Product $product) => $this->productDtoFactory->createFromModel($product));
    }

    /**
     * @inheritDoc
     */
    public function create(ProductCreateDto $productCreateDto): void
    {
        $product       = new Product();
        $product->name = $productCreateDto->name;

        if (!$product->save()) {
            throw new ProductCreateException();
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, ProductUpdateDto $productUpdateDto): void
    {
        $product = $this->findOneModelById($id);

        $product->name = $productUpdateDto->name;

        if (!$product->save()) {
            throw new ProductUpdateException($id);
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): void
    {
        $product = $this->findOneModelById($id);

        if (!$product->delete()) {
            throw new ProductDeleteException($id);
        }
    }

    /**
     * @param string $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    private function findOneModelById(string $id): Product
    {
        $product = Product::whereId($id)->first();

        if (is_null($product)) {
            throw new ProductNotFoundException($id);
        }

        return $product;
    }
}

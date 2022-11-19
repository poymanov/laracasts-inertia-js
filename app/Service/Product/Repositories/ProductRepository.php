<?php

namespace App\Service\Product\Repositories;

use App\Models\Product;
use App\Service\Product\Contracts\ProductDtoFactoryContract;
use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Dtos\ProductCreateDto;
use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Exceptions\ProductCreateException;
use App\Service\Product\Exceptions\ProductNotFoundException;
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
        $product = Product::where(['id' => $id])->first();

        if (is_null($product)) {
            throw new ProductNotFoundException($id);
        }

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
     * @param ProductCreateDto $productCreateDto
     *
     * @return void
     * @throws ProductCreateException
     */
    public function create(ProductCreateDto $productCreateDto): void
    {
        $product       = new Product();
        $product->name = $productCreateDto->name;

        if (!$product->save()) {
            throw new ProductCreateException();
        }
    }
}

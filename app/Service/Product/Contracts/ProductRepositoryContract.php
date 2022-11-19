<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductCreateDto;
use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Exceptions\ProductCreateException;
use App\Service\Product\Exceptions\ProductNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryContract
{
    /**
     * Получение товара по ID
     *
     * @param string $id
     *
     * @return ProductDto
     * @throws ProductNotFoundException
     */
    public function findOneById(string $id): ProductDto;

    /**
     * Получение всех товаров
     *
     * @param ProductFilterDto $filter
     *
     * @return LengthAwarePaginator
     */
    public function findAll(ProductFilterDto $filter): LengthAwarePaginator;

    /**
     * Создание товара
     *
     * @param ProductCreateDto $productCreateDto
     *
     * @return void
     * @throws ProductCreateException
     */
    public function create(ProductCreateDto $productCreateDto): void;
}

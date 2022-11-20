<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Exceptions\ProductCreateException;
use App\Service\Product\Exceptions\ProductNotFoundException;
use App\Service\Product\Exceptions\ProductUpdateException;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceContract
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
     * @param string $name
     *
     * @return void
     * @throws ProductCreateException
     */
    public function create(string $name): void;

    /**
     * Обновление товара
     *
     * @param string $id
     * @param string $name
     *
     * @return void
     * @throws ProductNotFoundException
     * @throws ProductUpdateException
     */
    public function update(string $id, string $name): void;
}

<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductCreateDto;
use App\Service\Product\Dtos\ProductDto;
use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Dtos\ProductUpdateDto;
use App\Service\Product\Exceptions\ProductCreateException;
use App\Service\Product\Exceptions\ProductDeleteException;
use App\Service\Product\Exceptions\ProductNotFoundException;
use App\Service\Product\Exceptions\ProductUpdateException;
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

    /**
     * Обновление товара
     *
     * @param string           $id
     * @param ProductUpdateDto $productUpdateDto
     *
     * @return void
     * @throws ProductNotFoundException
     * @throws ProductUpdateException
     */
    public function update(string $id, ProductUpdateDto $productUpdateDto): void;

    /**
     * Удаление товара
     *
     * @param string $id
     *
     * @return void
     * @throws ProductDeleteException
     * @throws ProductNotFoundException
     */
    public function delete(string $id): void;
}

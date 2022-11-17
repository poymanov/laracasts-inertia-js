<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductCreateDto;
use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Exceptions\ProductCreateException;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryContract
{
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

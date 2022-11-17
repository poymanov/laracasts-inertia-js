<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductFilterDto;
use App\Service\Product\Exceptions\ProductCreateException;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceContract
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
     * @param string $name
     *
     * @return void
     * @throws ProductCreateException
     */
    public function create(string $name): void;
}

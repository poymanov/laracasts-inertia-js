<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductFilterDto;
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
}

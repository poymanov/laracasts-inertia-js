<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductDto;

interface ProductRepositoryContract
{
    /**
     * Получение всех товаров
     *
     * @return ProductDto[]
     */
    public function findAll(): array;
}

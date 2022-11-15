<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductFilterDto;

interface ProductFilterDtoFactoryContract
{
    /**
     * @param int $paginationLimit
     *
     * @return ProductFilterDto
     */
    public function createFromParams(int $paginationLimit): ProductFilterDto;
}

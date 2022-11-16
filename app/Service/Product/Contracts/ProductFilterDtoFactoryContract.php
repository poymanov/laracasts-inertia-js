<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductFilterDto;

interface ProductFilterDtoFactoryContract
{
    /**
     * @param int         $paginationLimit
     * @param string|null $name
     *
     * @return ProductFilterDto
     */
    public function createFromParams(int $paginationLimit, ?string $name): ProductFilterDto;
}

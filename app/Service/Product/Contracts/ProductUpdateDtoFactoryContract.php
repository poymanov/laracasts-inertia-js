<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductUpdateDto;

interface ProductUpdateDtoFactoryContract
{
    /**
     * @param string $name
     *
     * @return ProductUpdateDto
     */
    public function createFromParams(string $name): ProductUpdateDto;
}

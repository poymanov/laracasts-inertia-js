<?php

namespace App\Service\Product\Contracts;

use App\Service\Product\Dtos\ProductCreateDto;

interface ProductCreateDtoFactoryContract
{
    /**
     * @param string $name
     *
     * @return ProductCreateDto
     */
    public function createFromParams(string $name): ProductCreateDto;
}

<?php

namespace App\Service\Product\Factories;

use App\Service\Product\Contracts\ProductCreateDtoFactoryContract;
use App\Service\Product\Dtos\ProductCreateDto;

class ProductCreateDtoFactory implements ProductCreateDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromParams(string $name): ProductCreateDto
    {
        $dto = new ProductCreateDto();
        $dto->name = $name;

        return $dto;
    }
}

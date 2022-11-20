<?php

namespace App\Service\Product\Factories;

use App\Service\Product\Contracts\ProductUpdateDtoFactoryContract;
use App\Service\Product\Dtos\ProductUpdateDto;

class ProductUpdateDtoFactory implements ProductUpdateDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromParams(string $name): ProductUpdateDto
    {
        $dto       = new ProductUpdateDto();
        $dto->name = $name;

        return $dto;
    }
}

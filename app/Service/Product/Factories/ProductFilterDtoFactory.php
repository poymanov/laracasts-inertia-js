<?php

namespace App\Service\Product\Factories;

use App\Service\Product\Contracts\ProductFilterDtoFactoryContract;
use App\Service\Product\Dtos\ProductFilterDto;

class ProductFilterDtoFactory implements ProductFilterDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromParams(int $paginationLimit, ?string $name): ProductFilterDto
    {
        $dto                  = new ProductFilterDto();
        $dto->paginationLimit = $paginationLimit;
        $dto->name            = $name;

        return $dto;
    }
}

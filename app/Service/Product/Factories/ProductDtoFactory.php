<?php

namespace App\Service\Product\Factories;

use App\Models\Product;
use App\Service\Product\Contracts\ProductDtoFactoryContract;
use App\Service\Product\Dtos\ProductDto;
use Illuminate\Database\Eloquent\Collection;

class ProductDtoFactory implements ProductDtoFactoryContract
{
    /**
     * @inheritDoc
     */
    public function createFromModel(Product $product): ProductDto
    {
        $dto       = new ProductDto();
        $dto->id   = $product->id;
        $dto->name = $product->name;

        return $dto;
    }

    /**
     * @inheritDoc
     */
    public function createFromModels(Collection $products): array
    {
        $dtos = [];

        foreach ($products as $product) {
            $dtos[] = $this->createFromModel($product);
        }

        return $dtos;
    }
}

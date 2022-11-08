<?php

namespace Tests\Helpers\ModelBuilder;

use App\Models\Product;

class ProductBuilder
{
    /**
     * Создание сущности {@see Product}
     *
     * @param array $params Параметры нового объекта
     *
     * @return Product
     */
    public function create(array $params = []): Product
    {
        return Product::factory()->createOneQuietly($params);
    }
}

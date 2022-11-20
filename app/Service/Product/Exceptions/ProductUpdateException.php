<?php

namespace App\Service\Product\Exceptions;

use Exception;

class ProductUpdateException extends Exception
{
    public function __construct(string $id)
    {
        $message = 'Failed to update product: ' . $id;

        parent::__construct($message);
    }
}

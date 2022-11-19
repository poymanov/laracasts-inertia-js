<?php

namespace App\Service\Product\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    public function __construct(string $id)
    {
        $message = 'Failed to find product with ID: ' . $id;

        parent::__construct($message);
    }
}

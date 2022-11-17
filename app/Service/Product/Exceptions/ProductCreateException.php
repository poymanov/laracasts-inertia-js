<?php

namespace App\Service\Product\Exceptions;

use Exception;

class ProductCreateException extends Exception
{
    public function __construct()
    {
        $message = 'Failed to create product.';

        parent::__construct($message);
    }
}

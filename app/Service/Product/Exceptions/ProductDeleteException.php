<?php

namespace App\Service\Product\Exceptions;

use Exception;

class ProductDeleteException extends Exception
{
    public function __construct(string $id)
    {
        $message = 'Failed to delete product: ' . $id;

        parent::__construct($message);
    }
}

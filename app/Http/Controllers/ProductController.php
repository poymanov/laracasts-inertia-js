<?php

namespace App\Http\Controllers;

use App\Service\Product\Contracts\ProductServiceContract;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __construct(private readonly ProductServiceContract $productService)
    {
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $products = $this->productService->findAll();

        return Inertia::render('Product/Index', [
            'products' => $products,
        ]);
    }
}

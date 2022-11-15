<?php

namespace App\Http\Controllers;

use App\Service\Product\Contracts\ProductFilterDtoFactoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductServiceContract $productService,
        private readonly ProductFilterDtoFactoryContract $productFilterDtoFactory
    ) {
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $filter   = $this->productFilterDtoFactory->createFromParams(config('pagination.products'));
        $products = $this->productService->findAll($filter);

        return Inertia::render('Product/Index', [
            'products' => $products,
        ]);
    }
}

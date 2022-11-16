<?php

namespace App\Http\Controllers;

use App\Service\Product\Contracts\ProductFilterDtoFactoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductServiceContract $productService,
        private readonly ProductFilterDtoFactoryContract $productFilterDtoFactory,
        private readonly int $paginationLimit
    ) {
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $filter   = $this->productFilterDtoFactory->createFromParams(
            $this->paginationLimit,
            $request->get('name')
        );
        $products = $this->productService->findAll($filter);

        return Inertia::render('Product/Index', [
            'products' => $products,
            'filters'  => $filter,
        ]);
    }
}

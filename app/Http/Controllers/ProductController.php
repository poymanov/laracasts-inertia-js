<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Service\Product\Contracts\ProductFilterDtoFactoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use App\Service\Product\Exceptions\ProductCreateException;
use App\Service\Product\Exceptions\ProductNotFoundException;
use App\Service\Product\Exceptions\ProductUpdateException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

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

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Product/Create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->productService->create($request->get('name'));

            return redirect()->route('product.index');
        } catch (ProductCreateException $e) {
            return redirect()->back()->with('alert.error', $e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
    }

    /**
     * @param string $id
     *
     * @return RedirectResponse|Response
     */
    public function show(string $id)
    {
        try {
            $product = $this->productService->findOneById($id);

            return Inertia::render('Product/Show', [
                'product' => $product,
            ]);
        } catch (ProductNotFoundException) {
            abort(\Illuminate\Http\Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
    }

    /**
     * @param string $id
     *
     * @return RedirectResponse|Response|void
     */
    public function edit(string $id)
    {
        try {
            $product = $this->productService->findOneById($id);

            return Inertia::render('Product/Edit', [
                'product' => $product,
            ]);
        } catch (ProductNotFoundException) {
            abort(\Illuminate\Http\Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
    }

    /**
     * @param UpdateRequest $request
     * @param string        $id
     *
     * @return RedirectResponse|void
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            $this->productService->update($id, $request->get('name'));

            return redirect()->route('product.index');
        } catch (ProductNotFoundException) {
            abort(\Illuminate\Http\Response::HTTP_NOT_FOUND);
        } catch (ProductUpdateException $e) {
            Log::error($e);

            return redirect()->back()->with('alert.error', $e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
    }
}

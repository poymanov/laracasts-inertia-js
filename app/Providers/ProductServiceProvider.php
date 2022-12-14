<?php

namespace App\Providers;

use App\Http\Controllers\ProductController;
use App\Service\Product\Contracts\ProductCreateDtoFactoryContract;
use App\Service\Product\Contracts\ProductDtoFactoryContract;
use App\Service\Product\Contracts\ProductFilterDtoFactoryContract;
use App\Service\Product\Contracts\ProductRepositoryContract;
use App\Service\Product\Contracts\ProductServiceContract;
use App\Service\Product\Contracts\ProductUpdateDtoFactoryContract;
use App\Service\Product\Factories\ProductCreateDtoFactory;
use App\Service\Product\Factories\ProductDtoFactory;
use App\Service\Product\Factories\ProductFilterDtoFactory;
use App\Service\Product\Factories\ProductUpdateDtoFactory;
use App\Service\Product\ProductService;
use App\Service\Product\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ProductController::class)
            ->needs('$paginationLimit')
            ->give(config('pagination.products'));

        $this->app->singleton(ProductUpdateDtoFactoryContract::class, ProductUpdateDtoFactory::class);
        $this->app->singleton(ProductCreateDtoFactoryContract::class, ProductCreateDtoFactory::class);
        $this->app->singleton(ProductFilterDtoFactoryContract::class, ProductFilterDtoFactory::class);
        $this->app->singleton(ProductDtoFactoryContract::class, ProductDtoFactory::class);
        $this->app->singleton(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->singleton(ProductServiceContract::class, ProductService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

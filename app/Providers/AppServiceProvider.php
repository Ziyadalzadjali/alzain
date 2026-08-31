<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Support\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Cart::class, fn () => new Cart());
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('*', fn ($view) => $view->with('cart', app(Cart::class)));

        View::composer(['layouts.app', 'partials.header', 'partials.footer'], function ($view) {
            $categoriesLoaded = \Illuminate\Support\Facades\Schema::hasTable('service_categories');

            $view->with('navServiceCategories', $categoriesLoaded
                ? ServiceCategory::active()->get() : collect());
            $view->with('navProductCategories', $categoriesLoaded
                ? ProductCategory::active()->get() : collect());
        });
    }
}

<?php

namespace App\Providers;

use App\View\Composers\PopularProductsComposer;
use App\View\Composers\WebsiteHeaderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer([
            'website.partials.header',
            'website.partials.slider'
        ], WebsiteHeaderComposer::class);

        View::composer([
            'website.partials.popular_products',
        ], PopularProductsComposer::class);
    }
}

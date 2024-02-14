<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Produit;

class LowQuantityProductsServiceProvider extends ServiceProvider
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
        view()->composer('*', function ($view) {
            $low_q = Produit::where('quantite', '<', 10)->get();
            $count_low_q = $low_q->count();
            $view->with(compact('low_q', 'count_low_q'));
        });
    }
}

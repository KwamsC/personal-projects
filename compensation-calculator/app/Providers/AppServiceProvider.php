<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('custom-paginator');
        Paginator::defaultSimpleView('custom-paginator');
        // Paginator::useTailwind();
        // Paginator::defaultView('custom-paginator.blade.php');

        // Paginator::defaultSimpleView('view-name');
    }
}

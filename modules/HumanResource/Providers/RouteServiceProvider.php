<?php

namespace Modules\HumanResource\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider 
{
    public function boot(): void
    {
        $this->routes(function () {
            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(__DIR__ .('/../routes.php'));
        });
    }
}
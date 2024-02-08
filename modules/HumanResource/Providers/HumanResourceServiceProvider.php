<?php

namespace Modules\HumanResource\Providers;

use Illuminate\Support\ServiceProvider;

class HumanResourceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'hr');

        $this->app->register(RouteServiceProvider::class);
    }
}
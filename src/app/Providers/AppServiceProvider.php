<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       log::info('********** Register Trigger **********');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        log::info('********** Boot Trigger **********');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Vercel terminates TLS before forwarding the request to the PHP
        // function. Ensure generated asset URLs retain the public HTTPS scheme.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

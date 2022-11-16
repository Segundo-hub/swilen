<?php

namespace App\Shared\Providers;

use Swilen\Petiole\Facades\Route;
use Swilen\Petiole\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register application routes from app.routes.php.
     *
     * @return void
     */
    public function boot()
    {
        Route::prefix('api')->group(function () {
            return app_path('app.routes.php');
        });
    }
}

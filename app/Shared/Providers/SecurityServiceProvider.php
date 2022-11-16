<?php

namespace App\Shared\Providers;

use Swilen\Petiole\ServiceProvider;
use Swilen\Security\Token\Jwt;

class SecurityServiceProvider extends ServiceProvider
{
    /**
     * Register application routes from app.routes.php.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jwt-token', function ($app) {
            return Jwt::register($app->make('config')->get('app.secret', ''), [
                'algorithm' => 'HS512',
                'expires' => '120s',
            ]);
        });
    }
}

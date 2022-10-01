<?php

namespace App\Shared\Http\Middleware;

use Swilen\Security\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * {@inheritdoc}
     */
    protected function secret()
    {
        return env('JWT_SECRET');
    }
}

<?php

namespace App\Shared\Http\Middleware;

use Swilen\Petiole\Facades\TokenManager;
use Swilen\Security\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Verify if user is authenticated.
     *
     * @param string $token
     *
     * @return \Swilen\Security\Token\Payload
     */
    protected function isAuthenticated(string $token)
    {
        return TokenManager::verify($token);
    }
}

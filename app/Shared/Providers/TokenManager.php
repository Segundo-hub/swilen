<?php

namespace App\Shared\Providers;

use Swilen\Security\Token\Jwt;
use Swilen\Security\Token\JwtPayload;

final class TokenManager
{
    /**
     * @param array $data Extra data for token
     *
     * @return array
     */
    public function sign(array $user)
    {
        $token = (new Jwt())->sign([
            'iat' => time(),
            'exp' => JwtPayload::time('+ 3 minute'),
            'data' => $user,
        ], env('JWT_SECRET'));

        return [
            'token' => $token->token,
            'user'  => $user
        ];
    }
}

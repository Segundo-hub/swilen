<?php

namespace App\Modules\Users;

use Swilen\Petiole\Facades\DB;
use App\Shared\Providers\TokenManager;

final class UserService
{
    /**
     * @var \App\Shared\Providers\TokenManager
     */
    protected $tokenManager;

    /**
     * @param \App\Shared\Providers\TokenManager $tokenManager
     */
    public function __construct(TokenManager $tokenManager)
    {
        $this->tokenManager = $tokenManager;
    }

    public function login($user)
    {
        if (!$userModel = DB::selectOne('SELECT * FROM users where email = ?', [$user->email])) {
            return 'User not found';
        }

        if (password_verify($user->password, $userModel->password) === false) {
            return 'Password mismatch';
        }

        $response = $this->tokenManager->sign([
            'id'       => $userModel->id,
            'username' => $userModel->username,
            'email'    => $userModel->email,
            'role'     => 'admin'
        ]);

        return $response;
    }

    public function store($user)
    {
        $hashedPassword = password_hash($user->password, PASSWORD_DEFAULT);

        $userId = DB::insert('INSERT INTO users (username, email, `password`) VALUES(?,?,?)', [
            $user->username,
            $user->email,
            $hashedPassword
        ]);

        $response = $this->tokenManager->sign([
            'id'    => $userId,
            'name'  => $user->username,
            'email' => $user->email,
            'role'  => 'admin'
        ]);

        return $response;
    }
}

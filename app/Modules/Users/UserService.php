<?php

namespace App\Modules\Users;

use Swilen\Petiole\Facades\DB;
use Swilen\Petiole\Facades\TokenManager;
use Swilen\Security\Hashing\Hash;

final class UserService
{
    /**
     * Login user to system.
     *
     * @param string $email
     * @param string $password
     *
     * @return bool|array
     */
    public function login(string $email, string $password)
    {
        if (!$user = DB::selectOne('SELECT * FROM users where email = ?', [$email])) {
            return false;
        }

        if (!Hash::check($password, $user->password)) {
            return false;
        }

        $response = TokenManager::sign([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => 'admin',
        ]);

        return $response;
    }

    /**
     * Register user and store to database.
     *
     * @param object $user
     *
     * @return array
     */
    public function store($user)
    {
        $userId = DB::insert('INSERT INTO users (username, email, `password`) VALUES(?,?,?)', [
            $user->username,
            $user->email,
            Hash::make($user->password),
        ]);

        $response = TokenManager::sign([
            'id' => $userId,
            'name' => $user->username,
            'email' => $user->email,
            'role' => 'admin',
        ]);

        return $response;
    }
}

<?php

namespace App\Modules\Users;

use App\Shared\Http\Controller\Controller;
use Swilen\Http\Request;

final class UserController extends Controller
{
    /**
     * @var \App\Modules\Users\UserService
     */
    private $service;

    /**
     * @param \App\Modules\Users\UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * User register controller
     *
     * @param \Swilen\Http\Request $request
     *
     * @return \Swilen\Http\Response
     */
    public function userSignIn(Request $request)
    {
        $user = request()->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($user->fails()) {
            return response()->send($user->errors());
        }

        $data = $this->service->store($user);

        return response()->send($data);
    }

    /**
     * User login controller
     *
     * @param \Swilen\Http\Request $request
     *
     * @return \Swilen\Http\Response
     */
    public function userSignUp(Request $request)
    {
        $user = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($user->fails()) {
            return response()->send($user->errors());
        }

        $data = $this->service->login($user);

        return $data;
    }
}

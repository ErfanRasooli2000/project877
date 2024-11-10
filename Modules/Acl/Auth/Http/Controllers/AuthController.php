<?php

namespace Modules\Acl\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Acl\Auth\Http\Requests\RegisterUserRequest;
use Modules\Acl\Auth\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $service
    ){}

    public function register(RegisterUserRequest $request) :JsonResponse
    {

    }

    public function sendLoginCode() :JsonResponse
    {

    }

    public function login() :JsonResponse
    {

    }

    public function logout() :JsonResponse
    {

    }
}

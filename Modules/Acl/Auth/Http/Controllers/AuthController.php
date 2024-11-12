<?php

namespace Modules\Acl\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Acl\Auth\Http\Requests\RegisterUserGetOtpRequest;
use Modules\Acl\Auth\Http\Requests\RegisterUserRequest;
use Modules\Acl\Auth\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $service
    ){}

    public function registerGetOtp(RegisterUserGetOtpRequest $request) :JsonResponse
    {
        $this->service->sendRegisterLoginCode($request->validated());
    }

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

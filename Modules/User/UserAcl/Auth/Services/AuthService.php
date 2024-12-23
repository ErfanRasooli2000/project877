<?php

namespace Modules\User\UserAcl\Auth\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\User\UserManagement\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\UserManagement\Http\Resources\UserDataResource;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ){}

    public function sendOtpCode(string $phoneNumber) :array
    {
        Cache::forget('user_otp_code_' . $phoneNumber);

        $otp = rand(100000, 999999);

        Cache::remember('user_otp_code_' . $phoneNumber , 180 , function () use ($otp) {
            return $otp;
        });

        //todo : send otp code here

        return [
            'status' => true,
            'message' => __('auth.otp_login_code_send_successfully'),
            'data' => ['code' => $otp],
        ];
    }

    public function register(array $data) :array
    {
        $hasSent = Cache::get('user_otp_for_number_' . $data['phone_number']);

        if (is_null($hasSent)) {
            return [
                'status' => false,
                'message' => __('auth.otp_has_expired'),
            ];
        }

        if ($data['otp'] != $hasSent['otp']) {
            return [
                'status' => false,
                'message' => __('auth.otp_is_wrong'),
            ];
        }

        $user = $this->userRepository->create($hasSent);

        return [
            'status' => true,
            'message' => __('auth.register_successfully'),
            'data' => [
                'token' => $user->createToken('main')->plainTextToken,
                'user' => new UserDataResource($user),
            ],
        ];
    }

    public function login(array $data) :array
    {
        $otp = Cache::get('otp_login_' . $data['phone_number']);

        if (is_null($otp) || $otp != $data['otp']) {
            return [
                'status' => false,
                'message' => __('auth.otp_has_expired'),
            ];
        }

        $user = $this->userRepository->findByFieldOrFail("phone_number", $data['phone_number']);

        return [
            'status' => true,
            'message' => __('auth.login_successfully'),
            'data' => [
                'token' => $user->createToken('main')->plainTextToken,
                'user' => new UserDataResource($user),
            ],
        ];
    }

    public function logout()
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return [
            'status' => true,
            'message' => __('auth.logged_out')
        ];
    }
}

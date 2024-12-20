<?php

namespace Modules\Acl\Auth\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Modules\UserManagement\Users\Database\Repositories\Contracts\AdminRepositoryInterface;
use Modules\UserManagement\Users\Http\Resources\AdminDataResource;

class AuthService
{
    public function __construct(
        protected AdminRepositoryInterface $userRepository,
    ){}

    public function sendRegisterLoginCode(array $data) :array
    {
        $otp = rand(100000, 999999);

        $hasSent = Cache::get('otp_for_number_' . $data['phone_number']);

        if ($hasSent) {
            return [
                'status' => false,
                'data' => $hasSent, // TODO : Remove THIS AFTER ADDING SMS
                'message' => __('auth.otp_has_been_sent'),
            ];
        }

        Cache::remember('otp_for_number_' . $data['phone_number'] , 180 , function () use ($data,$otp) {
            $data['otp'] = $otp;
            return $data;
        });

        //TODO : SEND OTP SMS

        return [
            'status' => true,
            'data' => ['otp' => $otp], // TODO : Remove THIS AFTER ADDING SMS
            'message' => __('auth.otp_send_successfully'),
        ];
    }

    public function register(array $data) :array
    {
        $hasSent = Cache::get('otp_for_number_' . $data['phone_number']);

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
                'user' => new AdminDataResource($user),
            ],
        ];
    }

    public function sendLoginCode(string $phoneNumber) :array
    {
        Cache::forget('otp_login_' . $phoneNumber);

        $otp = rand(100000, 999999);

        Cache::remember('otp_login_' . $phoneNumber , 180 , function () use ($otp) {
            return $otp;
        });

        return [
            'status' => true,
            'message' => __('auth.otp_login_code_send_successfully'),
            'data' => ['code' => $otp],
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
                'user' => new AdminDataResource($user),
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

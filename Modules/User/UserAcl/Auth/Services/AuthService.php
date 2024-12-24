<?php

namespace Modules\User\UserAcl\Auth\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\Address\Database\Repositories\Contracts\AddressRepositoryInterface;
use Modules\Admin\AdminAcl\RolePermissions\Database\Repositories\Contracts\RoleRepositoryInterface;
use Modules\User\UserManagement\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\UserManagement\Http\Resources\UserDataResource;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected AddressRepositoryInterface $addressRepository,
    ){}

    public function sendOtpCode(string $phoneNumber) :array
    {
        Cache::forget('user_login_otp_code_' . $phoneNumber);

        $otp = rand(100000, 999999);

        Cache::remember('user_login_otp_code_' . $phoneNumber , 600 , function () use ($otp) {
            return $otp;
        });

        //todo : send otp code here

        return [
            'status' => true,
            'message' => __('auth.otp_login_code_send_successfully'),
            'data' => [
                'code' => $otp,
                'user_exists' => $this->userRepository->checkUserExists($phoneNumber)
            ],
        ];
    }

    public function login(array $data) :array
    {
        if (!$this->checkOtpCode($data['phone_number'] , $data['otp']))
            return $this->wrongOtpMessage();


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

    public function register(array $data) :array
    {
        if (!$this->checkOtpCode($data['phone_number'] , $data['otp']))
            return $this->wrongOtpMessage();

        $user = null;

        \DB::transaction(function () use ($data,&$user) {

            $role = $data['role'];

            if ($role == 'salonOwner') {

                $address = $this->addressRepository->create($data);
                $data['address_id'] = $address->id;
            }

            $user = $this->userRepository->create($data);
            $user->assignRole($role);
        });


        return [
            'status' => true,
            'message' => __('auth.register_successfully'),
            'data' => [
                'token' => $user->createToken('main')->plainTextToken,
                'user' => new UserDataResource($user),
            ],
        ];
    }

    private function checkOtpCode(string $phoneNumber , string $otpCode) :bool
    {
        $otp = Cache::get('user_login_otp_code_' . $phoneNumber);

        if (is_null($otp) || $otp != $otpCode) {
            return false;
        }

        return true;
    }

    private function wrongOtpMessage() :array
    {
        return [
            'status' => false,
            'message' => __('auth.otp_has_expired'),
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

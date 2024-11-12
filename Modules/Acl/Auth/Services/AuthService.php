<?php

namespace Modules\Acl\Auth\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Base\Services\BaseService;

class AuthService
{
    public function sendRegisterLoginCode(array $data) :array
    {
        Cache::remember('otp_for_number_' . $data['phone_number'] , 180 , function () use ($data) {
            $data['otp'] = rand(100000, 999999);
            return $data;
        });

        return [
            'status' => true,
            'message' => __('auth.opt_send_successfully'),
        ];
    }
}

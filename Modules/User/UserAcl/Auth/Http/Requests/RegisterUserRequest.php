<?php

namespace Modules\User\UserAcl\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Base\Rules\IranMobileNumber;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => ['required' , 'unique:users,phone_number' , new IranMobileNumber],
            'otp' => ['required' , 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.unique' => __('auth.has_already_register')
        ];
    }
}

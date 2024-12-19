<?php

namespace Modules\Acl\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Base\Rules\IranMobileNumber;

class RegisterUserGetOtpRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'phone_number' => ['required' , 'unique:users,phone_number' , new IranMobileNumber],
        ];
    }
}

<?php

namespace Modules\UserManagement\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Base\Rules\IranMobileNumber;

class UserUpdateRequest extends FormRequest
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
            'first_name' => ['required' , 'string'],
            'last_name' => ['required' , 'string'],
            'phone_number' => ['required' , new IranMobileNumber , 'unique:users,phone_number,'.$this->route('user')->id],
            'email' => ['nullable' , 'email' , 'unique:users,email,'.$this->route('user')->id],
        ];
    }
}

<?php

namespace Modules\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IranMobileNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(\+98|0098|98|0)9\d{9}$/', (string)$value)) {
            $fail(__('base.iran_mobile_number_not_valid'));
        }

    }

    public static function validateNumber(mixed $value): bool
    {
        return (preg_match('/^(\+98|0098|98|0)9\d{9}$/', (string) $value));
    }
}



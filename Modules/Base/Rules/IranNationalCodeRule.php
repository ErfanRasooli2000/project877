<?php

namespace Modules\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IranNationalCodeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->custom_check_national_code($value))
            $fail(__('base.national_code_not_valid'));
    }

    public function custom_check_national_code($code)
    {
        if(!preg_match('/^[0-9]{10}$/',$code))
            return false;
        for($i=0;$i<10;$i++)
            if(preg_match('/^'.$i.'{10}$/',$code))
                return false;
        for($i=0,$sum=0;$i<9;$i++)
            $sum+=((10-$i)*intval(substr($code, $i,1)));
        $ret=$sum%11;
        $parity=intval(substr($code, 9,1));
        if(($ret<2 && $ret==$parity) || ($ret>=2 && $ret==11-$parity))
            return true;
        return false;
    }
}

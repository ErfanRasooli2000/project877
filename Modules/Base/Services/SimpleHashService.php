<?php

namespace Modules\Base\Services;

class SimpleHashService
{
    public static $digits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
    public static function encrypt16Base(int $number)
    {
        $number = $number * 23;
        $hash = base_convert($number , 10 , 16);
        return $hash;
    }

    public static function decrypt16Base(string $hash)
    {
        $hash = strtolower($hash);
        $nubmer = 0;
        while(isset($hash[0]))
        {
            if(in_array($hash[0] , self::$digits))
            {
                $nubmer += (array_search($hash[0],self::$digits)) * pow(16,strlen($hash)-1);
                $hash = substr($hash,1);
            }
            else
            {
                return false;
            }
        }

        $output = $nubmer / 23;

        if(is_int($output))
            return $output;
        else
            return false;
    }
}

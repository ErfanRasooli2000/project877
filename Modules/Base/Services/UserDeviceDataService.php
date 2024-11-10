<?php

namespace Modules\Base\Services;

use GeoIp2\Database\Reader;

class UserDeviceDataService
{
    public function getBrowser(): string
    {
        $user_agent = request()->header('User-Agent');
        $browserName = 'Unknown';


        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
            $browserName = 'Internet_Explorer';
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $browserName = 'Mozilla_Firefox';
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $browserName = 'Google_Chrome';
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $browserName = 'Apple_Safari';
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $browserName = 'Opera';
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            $browserName = 'Netscape';
        }

        return $browserName;
    }

    public function getPlatform() :string
    {
        $user_agent = request()->header('User-Agent');
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/iPhone/i', $user_agent)) {
            $platform = 'iPhone';
        } elseif (preg_match('/ipad/i', $user_agent)) {
            $platform = 'ipad';
        } elseif (preg_match('/Android/i', $user_agent)) {
            $platform = 'Android';
        } elseif (preg_match('/Windows Phone/i', $user_agent)) {
            $platform = 'Windows_Phone';
        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';
        } elseif (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';
        }

        return $platform;
    }

    public function getCountry() :string|null
    {
        $ip = request()->ip();

        if (str_contains($ip , '127.0.0') || str_contains($ip , '192.168'))
        {
            return "local";
        }

        try {
            $countryDbReader = new Reader(env('GEO_LITE_COUNTRY_DATABASE_PATH'));

        }catch (\Exception $exception){
            return null;
        }
        $country = $countryDbReader->country($ip);

        return $country->country->name;
    }

    public function getCity() :string|null
    {
        $ip = request()->ip();

        if (str_contains($ip , '127.0.0') || str_contains($ip , '192.168'))
        {
            return "local";
        }

        try {
            $cityDbReader = new Reader(env('GEO_LITE_CITY_DATABASE_PATH'));

        }catch (\Exception $exception){
            return null;
        }

        $city = $cityDbReader->city($ip);

        return $city->city->name;
    }

    public function getDataByRequest() :array
    {
        return [
            'ip' => request()->ip(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'device' => $this->getPlatform(),
            'browser' => $this->getBrowser(),
        ];
    }
}

<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class IpStack
{
    static $baseUrl='http://api.ipstack.com';
    static $key;
    public static function get($ip)
    {

        $response=Http::baseUrl(self::$baseUrl)
        ->get($ip,
    [
        'access_key'=>config('app.ipStack')
    ]);
    return $response->json();
    }
}
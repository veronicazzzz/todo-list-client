<?php

namespace Veronicazzzz\TodoListClient\Curl;

use Veronicazzzz\TodoListClient\Curl\Response;

class Request
{
    public static function sendGet(string $url, ?string $token = null): string|bool
    {
        return self::send('GET', $url, null, $token);
    }

    public static function sendPost(string $url, array $body, ?string $token = null): string|bool
    {
        return self::send('POST', $url, $body, $token);
    }

    public static function sendPut(string $url, array $body, ?string $token = null): string|bool
    {
        return self::send('PUT', $url, $body, $token);
    }

    public static function sendDelete(string $url, ?string $token = null): string|bool
    {
        return self::send('DELETE', $url, null, $token);
    }

    private static function send(string $requestType, string $url, ?array $body, ?string $token): string|bool
    {
        $curl = curl_init();

        curl_setopt_array($curl, self::getCurlOpts($url, $requestType, $token, $body));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    private static function getCurlOpts(string $url, string $requestType, ?string $token, ?array $body): array
    {
        $curlOpts = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_HTTPHEADER => self::getHeaders($token),
        ];

        if ($requestType === 'POST' || $requestType === 'PUT') {
            $curlOpts[CURLOPT_POSTFIELDS] = json_encode($body);
        }
        
        return $curlOpts;
    }

    private static function getHeaders(?string $token): array
    {
        return $token ? [
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ] : [
            'Content-Type: application/json'
        ];
    }
}
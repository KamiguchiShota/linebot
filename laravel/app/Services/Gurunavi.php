<?php
namespace App\Services;

use GuzzleHttp\Client;

class Gurunavi
{
    private const RESTAURANTS_SEARCH_API_URL = 'HTTPS://api.gnavi.co.jp/RestSearchAPI/v3/';
    public function searchRestaurants(string $word): array
    {
        $client = new Client();
        $response = $client
            ->get(self::RESTAURANTS_SEARCH_API_URL, [
                'query' => [
                    'keyid' => env('GURUNAVI_ACCESS_KEY'),
                    'freeword' => $word,
                    //str_replace 検索文字列に一致したすべての文字列を置換する
                ],
                'http_errors' => false,
            ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}

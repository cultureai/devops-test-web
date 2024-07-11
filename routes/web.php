<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function (): string {
    return 'Please visit /culture to test your application';
});

Route::get('culture', function(): string {
    //Test the cache system
    $cacheTestKey = 'TEST-KEY';
    Cache::put($cacheTestKey, Str::random());
    $randomCacheValue = Cache::get($cacheTestKey);

    //Test the API service
    $apiResult = Http::get(env('API_APP_URL') . '/api/secret')->throw()->json();

    return "The secret is: {$apiResult['secret']}, the random cache value for {$cacheTestKey} was {$randomCacheValue}";
});
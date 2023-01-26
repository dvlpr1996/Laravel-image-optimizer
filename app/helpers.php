<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

if (!function_exists('fullAssetPath')) {
    function fullAssetPath(string $path = ''): string
    {
        return storage_path(Config::get('path.assetPath') . $path);
    }
}

if (!function_exists('fullImagePath')) {
    function fullImagePath(string $path = ''): string
    {
        return storage_path(Config::get('path.imagePath') . $path);
    }
}

if (!function_exists('path')) {
    function path(string $path = ''): string
    {
        return storage_path('app/' . $path);
    }
}

if (!function_exists('appName')) {
    function appName(): string
    {
        return Str::slug(Config::get('app.name'));
    }
}

if (!function_exists('hasFile')) {
    function hasFile(): bool
    {
        if (count(Storage::allFiles('img/')) > 0) {
            return true;
        }
        return false;
    }
}

if (!function_exists('httpResponse')) {
    function httpResponse(string $message, string $statusCode)
    {
        return response()->json([
            'message' => $message,
            'status_code' => $statusCode,
        ], (int) $statusCode);
    }
}

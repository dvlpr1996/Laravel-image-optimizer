<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

function fullAssetPath(string $path = ''): string
{
    return storage_path(Config::get('path.assetPath') . $path);
}

function fullImagePath(string $path = ''): string
{
    return storage_path(Config::get('path.imagePath') . $path);
}

function path(string $path = ''): string
{
    return storage_path('app/' . $path);
}

function appName(): string
{
    return Str::slug(Config::get('app.name'));
}

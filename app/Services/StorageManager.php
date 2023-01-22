<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageManager
{
    public static function checkDirExists(string $dir)
    {
        if (!Storage::exists($dir)) {
            Storage::makeDirectory($dir);
        }
    }

    public static function deleteFile()
    {
    }
    
    public static function downloadFile()
    {
    }
}

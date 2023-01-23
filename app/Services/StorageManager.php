<?php

namespace App\Services;

use Exception;
use App\Services\Zip;
use Illuminate\Support\Facades\Storage;

class StorageManager
{
    public function __construct(
        private $zip = new Zip,
    ) {
    }

    public static function checkDirExists(string $dir)
    {
        if (!Storage::exists($dir)) {
            Storage::makeDirectory($dir);
        }
    }

    public function deleteFile()
    {
    }

    public function downloadFile($pathToDownload)
    {
        try {
            $this->zip->zipFiles($pathToDownload);
            return response()->download($this->zip->zipFileName($pathToDownload));
        } catch (Exception $e) {
            return back()->withError("Something went wrong try again");
        }
    }
}

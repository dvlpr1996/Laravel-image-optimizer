<?php

namespace App\Services;

use Exception;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class Zip
{
    public function zipFileName($pathToDownload)
    {
        return path($pathToDownload) . appName() . '.zip';
    }

    public function zipFiles(string $pathToDownload)
    {
        $zip = new ZipArchive;
        if ($zip->open($this->zipFileName($pathToDownload), ZipArchive::CREATE) !== TRUE) {
            throw new Exception('Something went wrong try again');
        }

        foreach (Storage::files($pathToDownload) as $key => $value) {
            $zip->addFile(path() . $value, basename($value));
        }
        $zip->close();
    }
}

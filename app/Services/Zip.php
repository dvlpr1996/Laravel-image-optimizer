<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Zip
{
    public function zipFileName($pathToDownload)
    {
        return path($pathToDownload).appName().'.zip';
    }

    public function zipFiles(string $pathToDownload)
    {
        $zip = new ZipArchive;
        if ($zip->open($this->zipFileName($pathToDownload), ZipArchive::CREATE) !== true) {
            throw new Exception(__('app.error'));
        }

        foreach (Storage::files($pathToDownload) as $key => $value) {
            $zip->addFile(path().$value, basename($value));
        }
        $zip->close();
    }
}

<?php

namespace App\Services;

use Exception;
use App\Services\Zip;
use App\Services\FileHandler;
use Illuminate\Support\Facades\Storage;

class StorageManager
{
    public function __construct(
        private $zip = new Zip,
        private $fileHandler = new FileHandler,
    ) {
    }

    public static function checkDirExists(string $dir)
    {
        if (!Storage::exists($dir)) {
            Storage::makeDirectory($dir);
        }
    }

    public function deleteFile(string $path)
    {
        $fileCollection = collect(Storage::allFiles($path));
        $filtered = $fileCollection->filter(function ($value, $key) {
            return Storage::mimeType($value) !== 'application/zip';
        });

        foreach ($filtered->all() as $key => $file) {
            Storage::delete($file);
        }
    }

    public function checkDownloadFileExists(string $dir): bool
    {
        if (!Storage::exists($dir) || !Storage::has($this->zip->zipFileName($dir))) {
            return false;
        }
        return true;
    }

    public function downloadFile($pathToDownload, array $header = [])
    {
        try {
            $this->zip->zipFiles($pathToDownload);
            $this->deleteFile($pathToDownload);
            return response()->download($this->zip->zipFileName($pathToDownload), headers: $header)->deleteFileAfterSend(true);
        } catch (Exception $e) {
            return back()->withError(__('app.error'));
        }
    }
}

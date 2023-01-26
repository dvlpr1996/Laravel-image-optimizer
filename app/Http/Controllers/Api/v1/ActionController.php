<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\Zip;
use App\Services\Uploader;
use App\Services\StorageManager;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    public function __construct(
        private $storageManager = new StorageManager,
        private $uploader = new Uploader,
        private $zip = new Zip,
    ) {
    }

    public function action(FileRequest $request)
    {
        foreach ($request->file('files') as $file) {
            if ($this->uploader->uploadImage($file)) {
                return httpResponse(__('app.img_upload_ok'), '200');
            }
            return httpResponse(__('app.img_upload_error'), '404');
        }
    }

    public function download()
    {
        if (!Storage::exists('img/') && !Storage::has($this->zip->zipFileName('img/')))
            httpResponse(__('app.file_not_found'), '404');
        return $this->storageManager->downloadFile('img/', ['Content-Type:application/zip']);
    }
}

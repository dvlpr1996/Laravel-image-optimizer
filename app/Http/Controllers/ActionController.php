<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\FileHandler;
use App\Services\StorageManager;
use App\Services\Uploader;

class ActionController extends Controller
{
    public function __construct(
        private $storageManager = new StorageManager,
        private $fileHandler = new FileHandler,
        private $uploader = new Uploader,
    ) {
    }

    public function action(FileRequest $request)
    {
        foreach ($request->file('files') as $file) {
            if ($this->fileHandler->isImage($file)) {
                $this->uploader->uploadImage($file);
                // return $this->storageManager->downloadFile('img/');
                return back()->with('success', __('app.img_upload_ok'));
            }
        }
    }
}

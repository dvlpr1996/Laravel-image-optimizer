<?php

namespace App\Http\Controllers;

use App\Services\Zip;
use App\Services\Uploader;
use App\Services\StorageManager;
use App\Http\Requests\FileRequest;
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
                return view('index')->with('success', __('app.img_upload_ok'));
            }
            return back()->withErrors('errors', __('app.img_upload_error'));
        }
    }

    public function download()
    {
        if ($this->storageManager->checkDownloadFileExists('img/'))
            abort(404);
        return $this->storageManager->downloadFile('img/');
    }
}

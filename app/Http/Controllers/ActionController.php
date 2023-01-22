<?php

namespace App\Http\Controllers;

use App\Services\Uploader;
use App\Services\FileHandler;
use App\Http\Requests\FileRequest;

class ActionController extends Controller
{
    public function __construct(
        private $fileHandler = new FileHandler,
        private $uploader = new Uploader,
    ) {
    }

    public function action(FileRequest $request)
    {
        foreach ($request->file('files') as $file) {
            if ($this->fileHandler->isImage($file)) {
                $this->uploader->uploadImage($file);
                return back()->with('success','image successfully uploaded');
            }

            if ($this->fileHandler->isAsset($file)) {
                $this->uploader->uploadAssets($file);
                return back()->with('success','asset successfully uploaded');
            }
        }
    }
}

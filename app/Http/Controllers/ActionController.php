<?php

namespace App\Http\Controllers;

use App\Services\FileHandler;
use App\Http\Requests\FileRequest;

class ActionController extends Controller
{
    private $assetPath;
    private $imagePath;
    private $fileHandler;

    public function __construct()
    {
        $this->fileHandler = new FileHandler($this->imagePathSetter(), $this->assetPathSetter());
    }

    private function assetPathSetter()
    {
        $this->assetPath = storage_path('app/asset/');
    }

    private function imagePathSetter()
    {
        $this->imagePath = storage_path('app/img/');
    }

    public function action(FileRequest $request)
    {
        foreach ($request->file('files') as $file) {
            if ($this->fileHandler->isImage($file)) {

            }
        }
        # file type
        # action based on file type    design patter
    }
}

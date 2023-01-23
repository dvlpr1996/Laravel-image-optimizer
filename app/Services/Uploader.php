<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class Uploader
{
    public function __construct(
        private $fileHandler = new FileHandler
    ) {
    }

    public function uploadImage($imageFile)
    {
        StorageManager::checkDirExists('/img/');

        $image = Image::make($imageFile);
        $filePath = $this->fileHandler->generateFileName($imageFile);
        $img = $image->save($this->fileHandler->imagePath().$filePath);

        if (! $img) {
            abort(500, __('app.img_upload_error'));
        }

        return true;
    }
}

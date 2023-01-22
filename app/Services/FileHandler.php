<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class FileHandler
{
    private $imageType = ['image/png', 'image/jpeg'];
    private $assetType = ['text/css', 'text/javascript', 'text/html'];

    public function assetPath()
    {
        return storage_path(Config::get('path.assetPath'));
    }

    public function imagePath()
    {
        return storage_path(Config::get('path.imagePath'));
    }

    public function generateFileName($file): string
    {
        $randomName = Str::slug(Config::get('app.name') . '-' . mt_rand(0, time()));
        return  $randomName . '.' . $this->getFileExtension($file);
    }

    public function getFileType($file): string
    {
        return $file->getMimeType();
    }

    public function getOriginalFileSize($file): string
    {
        return $this->formatSizeUnits($file->getSize());
    }

    public function getOriginalFileName($file): string
    {
        return $file->getClientOriginalName();
    }

    public function getFileExtension($file): string
    {
        return $file->extension();
    }

    public function isCss($file)
    {
        if ($this->checkType($file) !== 'css')
            return false;
        return true;
    }

    public function isHtml($file)
    {
        if ($this->checkType($file) !== 'html')
            return false;
        return true;
    }

    public function isJs($file)
    {
        if ($this->checkType($file) !== 'js')
            return false;
        return true;
    }

    public function isImage($file)
    {
        if ($this->checkType($file) !== 'img')
            return false;
        return true;
    }

    public function isAsset($file)
    {
        if (!in_array($file, ['html', 'css', 'js']))
            return false;
        return true;
    }

    private function checkType($file): ?string
    {
        $fileType = $this->getFileType($file);
        $extension = $this->getFileExtension($file);

        if (in_array($fileType, $this->imageType))
            return 'img';

        if (in_array($fileType, $this->assetType) && $extension === 'css')
            return 'css';

        if (in_array($fileType, $this->assetType) && $extension === 'js')
            return 'js';

        if (in_array($fileType, $this->assetType) && $extension === 'html')
            return 'html';

        return null;
    }

    private function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

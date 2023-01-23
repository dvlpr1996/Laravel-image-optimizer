<?php

namespace App\Services;

use Illuminate\Support\Str;

class FileHandler
{
    private $imageType = ['image/png', 'image/jpeg'];

    public function imagePath(string $path = ''): string
    {
        return fullImagePath($path);
    }

    public function generateFileName($file): string
    {
        $randomName = Str::slug(appName().'-'.mt_rand(0, time()));

        return  $randomName.'.'.$this->getFileExtension($file);
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

    public function isImage($file)
    {
        if ($this->checkType($file) !== 'img') {
            return false;
        }

        return true;
    }

    private function checkType($file): ?string
    {
        if (in_array($this->getFileType($file), $this->imageType)) {
            return 'img';
        }

        return null;
    }

    private function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2).' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2).' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2).' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes.' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes.' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

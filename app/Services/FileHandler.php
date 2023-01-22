<?php

namespace App\Services;

class FileHandler
{
    public function __construct(
        private $assetPath,
        private $imagePath,
        private $imageType = ['image/png', 'image/jpeg'],
        private $assetType = ['text/css', 'text/javascript', 'text/html'],
    ) {
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

<?php

namespace App\Http\Services\Admin\Log;

class LogService
{
    public static function getFiles()
    {
        $path = storage_path("/logs");
        $files = \File::allFiles($path);

        $allFiles = [];
        foreach ($files as $file) {
            array_push($allFiles, $file->getFilename());
        }

        return $allFiles;
    }
}

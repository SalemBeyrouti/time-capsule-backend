<?php

namespace App\Services\User;

use ZipArchive;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ZipExportService
{
    static function generateZipForCapsules(int $capsuleId) {
        $mediaItems = Media::where('capsule_id', $capsuleId)->get();

        if ($mediaItems->isEmpty()) {
            return null;
        }

        $zipFolder = storage_path("app/temp_zip_$capsuleId");
        if (!is_dir($zipFolder)) { mkdir($zipFolder, 0755, true); }

        foreach ($mediaItems as $index => $media) { 
            if ($media->type === 'text' && $media->content) {
                 $filename = "$zipFolder/text_{$index}.txt";
                 file_put_contents($filename, $media->content);
            }
            if (in_array($media->type, ['image', 'audio']) && $media->url) {
                $path = storage_path("app/public/" . ltrim($media->url, '/storage/'));
                if (file_exists($path)) {
                    $basename = basename($path);
                    copy($path, "$zipFolder/$basename");
                }
            }
        }

        $zipFilePath = storage_path("app/exports/capsule_$capsuleId.zip");
        if (!is_dir(dirname($zipFilePath))) {
            mkdir(dirname($zipFilePath), 0755, true);
        }
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = scandir($zipFolder);
            foreach ($files as $file) {
                 if (in_array($file, ['.', '..'])) continue;
                 $zip->addFile("$zipFolder/$file", $file);
            }
            $zip->close();
        }else {
            return null;
        }
        return $zipFilePath;

    }
}

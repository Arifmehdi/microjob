<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileManagementServices
{

    public function updateImage($file, $old_image = '', $directory = 'upload', $prefix = ''): string
    {
        $file_ext  = $file->getClientOriginalExtension();
        $directory = rtrim($directory, ' /,');
        //Check And Create Directory
        $disk = Storage::disk('public');
        if (!$disk->exists($directory)) {
            $disk->makeDirectory($directory);
        }
        $imageName = $prefix . date('ymdhisa') . '-' . uniqid() . '.' . $file_ext;

        $disk->put($directory . '/' . $imageName, $file->getContent());

        //Check And delete Old file
        if ($old_image && $disk->exists($directory . '/' . $old_image)) {
            $disk->delete($directory . '/' . $old_image);
        }

        return $imageName;
    }

    public function deleteImage($imageName, $directory = 'upload'): void
    {
        $disk = Storage::disk('public');
        //Check And delete Old file
        if ($imageName && $disk->exists($directory . '/' . $imageName)) {
            $disk->delete($directory . '/' . $imageName);
        }
    }
}

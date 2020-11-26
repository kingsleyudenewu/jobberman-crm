<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadFile(UploadedFile $file, $folder, $rename = false, $disk = null)
    {
        if (! $file instanceof  UploadedFile) {
            return false;
        }

        if (is_null($disk)) {
            $disk = config('jobberman.disk_folder');
        }

        if ($rename) {
            $imageName = $file->getClientOriginalName();
            return $file->storeAs($folder, time().$imageName, $disk);
        }
        return $file->store($folder, $disk);


    }

    public function deleteFile($path = null, $disk = null)
    {
        if (is_null($disk)) {
            $disk = config('jobberman.disk_folder');
        }
        Storage::disk($disk)->delete($path);
    }
}

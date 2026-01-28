<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class S3Service
{
    protected string $disk = 's3';

    public function upload(UploadedFile $uploadedFile, Model $model, string $directory = 'files'): File
    {
        $fileName = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path = $uploadedFile->storeAs($directory, $fileName, ['disk' => $this->disk]);

        return $model->image()->create([
            'path' => $path,
            'disk' => $this->disk,
            'filename' => $uploadedFile->getClientOriginalName(),
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
        ]);
    }

    public function uploadFile(UploadedFile $file, string $directory = 'products'): string
    {
        // Legacy support or direct path usage
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($directory, $fileName, ['disk' => $this->disk, 'visibility' => 'public']);
    }

    public function deleteFile(string $path): bool
    {
        if (Storage::disk($this->disk)->exists($path)) {
            return Storage::disk($this->disk)->delete($path);
        }

        return false;
    }

    public function getUrl(string $path): string
    {
        return Storage::disk($this->disk)->url($path);
    }
}

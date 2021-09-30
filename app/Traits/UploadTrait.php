<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadTrait
{
    public function multipleUploads(array $files, string $folder, string $disk = 'public')
    {
        $uploadFiles = collect();
        foreach ($files as $file) {
            $uploadFiles = $uploadFiles->push($this->uploadFile($file, $folder, $disk));
        }
        return $uploadFiles;
    }

    public function uploadFile(UploadedFile $file, string $folder, string $disk = 'public')
    {
        $dadosFile = [
            'url' => $file->hashName(),
            'extensao' => $file->getClientOriginalExtension(),
            'tamanho' => $file->getSize(),
            'descricao' => $file->getClientOriginalName()
        ];
        \Storage::disk($disk)->putFile($folder, $file);
        return $dadosFile;
    }
}

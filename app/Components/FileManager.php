<?php
namespace App\Components;

use App\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public function createImageUploder($inputName)
    {
        return new ImageUploader($inputName);
    }

    public function createDocumentUploder($inputName)
    {
        return new DocumentUploader($inputName);
    }
}

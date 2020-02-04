<?php
namespace App\Components;

use App\File;
use Illuminate\Support\Facades\Storage;

class DocumentUploader extends Uploader
{
    protected function validate()
    {
        $mimes = implode(",", config('filehelper.documentExtensions'));
        $validatedData = request()->validate([
            $this->inputName => "file|mimes:$mimes|max:$this->maxSize",
        ]);
        $this->file = $validatedData[$this->inputName];

        if (is_null($this->file)) {
            return false;
        }

        return true;
    }
}

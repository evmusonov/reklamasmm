<?php
namespace App\Components;

use App\Exceptions\FileNotFoundUploadException;
use App\Exceptions\UploadedFileDoesNotExistException;
use App\File;
use Illuminate\Support\Facades\Storage;

abstract class Uploader
{
    /**
     * Maximum file size in kilobytes
     *
     * @var int
     */
    public $maxSize = 1024 *  2;
    /**
     * Path to the file storage in depending on the module
     * For example: public/service/{$id}
     * It places in /storage/app/public
     *
     * @var string
     */
    protected $storagePath = 'public/';
    protected $filePath;
    protected $filename;
    protected $contentId;
    protected $module;
    protected $file;
    protected $errors;
    protected $inputName;

    public function __construct($inputName)
    {
        $this->inputName = $inputName;
        $this->filePath = config('filehelper.pathToStorage') . '/app/';
    }

    public function upload($path)
    {
        $this->storagePath .= $path;
        $this->filePath .= $this->storagePath;
        if ($this->validate()) {

            $folders = explode("/", $path);
            if (count($folders)) {
                $folders = array_reverse($folders);
                if (isset($folders[0])) {
                    $this->contentId = $folders[0];
                }
                if (isset($folders[1])) {
                    $this->module = $folders[1];
                }
            }

            if ($this->file->getError() == 0) {
                $this->filename = time() . '_' . $this->file->getClientOriginalName();
                File::create([
                    'filename'   => $this->filename,
                    'module'     => $this->module,
                    'content_id' => $this->contentId,
                ]);
                Storage::putFileAs($this->storagePath, $this->file, $this->filename);

                if (!file_exists($this->filePath . '/' . $this->filename)) {
                    throw new FileNotFoundUploadException('Uploaded file not found, check your storage path in the uploader config');
                }
            }
        }

        return $this;
    }

    abstract protected function validate();
}

<?php
namespace App\Components;

use App\File;
use Illuminate\Support\Facades\Storage;

class FileHelper
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
    private $storagePath = 'public/';
    private $filePath = __DIR__ . '/../../storage/app/';
    private $filename;
    private $contentId;
    private $module;
    private $file;
    private $errors;

    public function __construct($contentId, $module)
    {
        $this->contentId = $contentId;
        $this->module = $module;

        $this->storagePath .= "$this->module/$this->contentId";
        $this->filePath .= $this->storagePath;
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->file->getError() == 0) {
                $this->filename = time() . '_' . $this->file->getClientOriginalName();
                File::create([
                    'filename'   => $this->filename,
                    'module'     => $this->module,
                    'content_id' => $this->contentId,
                ]);
                Storage::putFileAs($this->storagePath, $this->file, $this->filename);

                if (!file_exists($this->filePath . '/' . $this->filename)) {
                    // Throw Exception
                }

                return $this;
            }
        }
    }

    private function validate()
    {
        $validatedData = request()->validate([
            'image' => "image|mimetypes:image/jpeg,image/png|max:$this->maxSize",
        ]);
        $this->file = $validatedData['image'];

        if (is_null($this->file)) {
            return false;
        }

        return true;
    }

    public function resize($width, $height, $dirForSave, $quality = 100)
    {
        if (!is_null($this->file)) {
            $fullPath = $this->filePath . DIRECTORY_SEPARATOR . $this->filename;
            list($currentWidth, $currentHeight, $type) = getimagesize($fullPath); // Получаем размеры и тип изображения (число)
            if ($width === false && $height === false) {
                //Throw Exception
            }
            if (empty($dirForSave)) {
                //Throw Exception
            }
            /*
             * If width is false, width resizes depending on height
             */
            if ($width === false) {
                $heightPercent = $height * 100 / $currentHeight;
                $width = round($currentWidth * $heightPercent / 100);
            }
            /*
             * If height is false do the same operation
             */
            if ($height === false) {
                $widthPercent = $width * 100 / $currentWidth;
                $height =round($currentHeight * $widthPercent / 100);
            }

            $outFile = $this->filePath . DIRECTORY_SEPARATOR . $dirForSave . DIRECTORY_SEPARATOR . $this->filename;

            $im = imagecreatefromjpeg($fullPath);
            $im1 = imagecreatetruecolor($width, $height);
            imagecopyresampled($im1, $im,0,0,0,0, $width, $height, imagesx($im), imagesy($im));

            $dir = $this->filePath . DIRECTORY_SEPARATOR . $dirForSave;
            if (!is_dir($dir)) {
                mkdir($this->filePath . DIRECTORY_SEPARATOR . $dirForSave, 0664);
            }

            imagejpeg($im1, $outFile, $quality);
            imagedestroy($im);
            imagedestroy($im1);



//            $xCropPosition = 0;
//            $yCropPosition = 0;
//            $fullPath = $this->filePath . DIRECTORY_SEPARATOR . $this->filename;
//
//            if (($width < 0) || ($height < 0)) {
//                echo "Некорректные входные параметры";
//                return false;
//            }
//
//            list($w_i, $h_i, $type) = getimagesize($fullPath); // Получаем размеры и тип изображения (число)
//            $types = ["", "gif", "jpeg", "png"]; // Массив с типами изображений
//            $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
//
//            if ($ext) {
//                $func = 'imagecreatefrom' . $ext; // Получаем название функции, соответствующую типу, для создания изображения
//                $img_i = $func($fullPath); // Создаём дескриптор для работы с исходным изображением
//            } else {
//                echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
//                return false;
//            }
//
//            if ($xCropPosition + $width > $w_i) $w_o = $w_i - $xCropPosition; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
//            if ($yCropPosition + $height > $h_i) $h_o = $h_i - $yCropPosition; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
//
//            $img_o = imagecreatetruecolor($width, $height); // Создаём дескриптор для выходного изображения
//            imagecopy($img_o, $img_i, 0, 0, $xCropPosition, $yCropPosition, $width, $height); // Переносим часть изображения из исходного в выходное
//            $func = 'image' . $ext; // Получаем функция для сохранения результата
//
//            $dir = $this->filePath . DIRECTORY_SEPARATOR . $width . 'x' . $height;
//            if (!is_dir($dir)) {
//                mkdir($this->filePath . DIRECTORY_SEPARATOR . $width . 'x' . $height, 0664);
//            }
//
//            return $func($img_o, $this->filePath . DIRECTORY_SEPARATOR . $width . 'x' . $height . DIRECTORY_SEPARATOR . $this->filename); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
        } else {
            // Throw Exception
        }
    }
}

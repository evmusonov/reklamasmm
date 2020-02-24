<?php
namespace App\Components;

use App\Exceptions\WrongSizesUploadException;
use App\Exceptions\ResizeDirNotFoundUploadException;
use App\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class ImageUploader extends Uploader
{
    protected function validate()
    {
        $mimes = implode(",", config('filehelper.imageExtensions'));
        if (request($this->inputName)) {
            $validatedData = request()->validate([
                $this->inputName => "image|mimes:$mimes|max:$this->maxSize",
            ]);
            $this->file = $validatedData[$this->inputName];

            if (is_null($this->file)) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }

    public function resize($width, $height, $dirForSave, $quality = 100)
    {
        $params = [
            'width'      => $width,
            'height'     => $height,
            'dirForSave' => $dirForSave
        ];

        try {
			if (!is_null($this->file) && $this->validateResizeParams($params)) {
				$fullPath = $this->filePath . DIRECTORY_SEPARATOR . $this->filename;
				list($currentWidth, $currentHeight, $type) = getimagesize($fullPath); // Получаем размеры и тип изображения (число)
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
					$height = round($currentHeight * $widthPercent / 100);
				}

				$outFile = $this->filePath . DIRECTORY_SEPARATOR . $dirForSave . DIRECTORY_SEPARATOR . $this->filename;

				$im = imagecreatefromjpeg($fullPath);
				$im1 = imagecreatetruecolor($width, $height);
				imagecopyresampled($im1, $im, 0, 0, 0, 0, $width, $height, imagesx($im), imagesy($im));

				$dir = $this->filePath . DIRECTORY_SEPARATOR . $dirForSave;
				if (!is_dir($dir)) {
					mkdir($this->filePath . DIRECTORY_SEPARATOR . $dirForSave, 0755);
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
			}
		} catch (Exception $exception) {
			FileHelper::deleteFile($this->filePath, $this->filename);
			throw $exception;
		}
    }

    private function validateResizeParams($params)
    {
        if (!is_int($params['width']) && !is_int($params['height'])) {
            throw new WrongSizesUploadException('Wrong size params for uploaded image');
        }
        if (empty($params['dirForSave'])) {
            throw new ResizeDirNotFoundUploadException('No directory specified for resized image');
        }

        return true;
    }
}

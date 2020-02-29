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
        if (request()->has($this->inputName)) {
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

    public function resize($versionName)
    {
        $versions = config('filehelper.versions');
        $versionData = $versions[$versionName];

        $params = [
            'width'      => $versionData['width'],
            'height'     => $versionData['height'],
            'quality'    => $versionData['quality'],
            'dirForSave' => $versionName
        ];

        try {
			if (!is_null($this->file) && $this->validateResizeParams($params)) {
			    $mimeType = $this->file->getMimeType();
			    $extension = explode('/', $mimeType)[1];
				$fullPath = $this->filePath . DIRECTORY_SEPARATOR . $this->filename;
				list($currentWidth, $currentHeight) = getimagesize($fullPath); // Получаем размеры и тип изображения (число)
				$newHeight = $params['height'];
				$newWidth = $params['width'];
                if (is_int($params['width']) && is_int($params['height'])) {
				    if ($currentWidth > $currentHeight) {
                        $widthPercent = $params['width'] * 100 / $currentWidth;
                        $newHeight = round($currentHeight * $widthPercent / 100);
                    } else {
                        $heightPercent = $params['height'] * 100 / $currentHeight;
                        $newWidth = round($currentWidth * $heightPercent / 100);
                    }
                } else {
                    /*
                     * If width is false, width resizes depending on height
                     */
                    if ($params['width'] === false) {
                        $heightPercent = $params['height'] * 100 / $currentHeight;
                        $newWidth = round($currentWidth * $heightPercent / 100);
                    }
                    /*
                     * If height is false do the same operation
                     */
                    if ($params['height'] === false) {
                        $widthPercent = $params['width'] * 100 / $currentWidth;
                        $newHeight = round($currentHeight * $widthPercent / 100);
                    }
                }

				$outFile = $this->filePath . DIRECTORY_SEPARATOR . $params['dirForSave'] . DIRECTORY_SEPARATOR . $this->filename;

				$creatfrom = 'imagecreatefrom' . $extension;
				$im = $creatfrom($fullPath);
				if ($extension == 'png') {
                    $white = imagecolorexact($im, 255, 255, 255);
                    imagecolortransparent($im, $white);
                } else {
                    $im1 = imagecreatetruecolor($params['width'], $params['height']);
                    $dstX = 0;
                    $dstY = 0;
                    if ($params['width'] <= $params['height']) {
                        $dstX = ($params['width'] - $newWidth) / 2;
                    } else {
                        $dstY = ($params['height'] - $newHeight) / 2;
                    }
                    $white = imagecolorallocate($im1, 255, 255, 255);
                    imagefill($im1, 0, 0, $white); // Custom background color for new image
                    imagecopyresampled($im1, $im, $dstX, $dstY, 0, 0, $newWidth, $newHeight, imagesx($im), imagesy($im));
                }

				$dir = $this->filePath . DIRECTORY_SEPARATOR . $params['dirForSave'];
				if (!is_dir($dir)) {
					mkdir($this->filePath . DIRECTORY_SEPARATOR . $params['dirForSave'], 0755);
				}

				$image = 'image' . $extension;
				if ($extension == 'png') {
                    $quality = 2;
                    $image($im, $outFile, $quality);
                } else {
                    $image($im1, $outFile, $params['quality']);
                    imagedestroy($im1);
                }
				imagedestroy($im);


//                $xCropPosition = 0;
//                $yCropPosition = 0;
//                $fullPath = $outFile;
//
//                list($w_i, $h_i, $type) = getimagesize($fullPath); // Получаем размеры и тип изображения (число)
//                $types = ["", "gif", "jpeg", "png"]; // Массив с типами изображений
//                $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
//
//                if ($ext) {
//                    $func = 'imagecreatefrom' . $ext; // Получаем название функции, соответствующую типу, для создания изображения
//                    $img_i = $func($fullPath); // Создаём дескриптор для работы с исходным изображением
//                } else {
//                    echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
//                    return false;
//                }
//
//                if ($xCropPosition + $width > $w_i) $w_o = $w_i - $xCropPosition; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
//                if ($yCropPosition + $height > $h_i) $h_o = $h_i - $yCropPosition; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
//
//                $img_o = imagecreatetruecolor($width, $height); // Создаём дескриптор для выходного изображения
//                imagecopy($img_o, $img_i, 0, 0, $xCropPosition, $yCropPosition, $width, $height); // Переносим часть изображения из исходного в выходное
//                $func = 'image' . $ext; // Получаем функция для сохранения результата
//
//                $func($img_o, $fullPath); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
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

<?php
namespace App\Components;

use Evmusonov\LaravelFileHelper\File;

class ImgHelper
{
    public static function getPath($module, $dir, $contentId, $filename)
    {
        if (!empty($dir)) {
            return File::$dir . $module . DIRECTORY_SEPARATOR . $contentId . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $filename;
        }

        return File::$dir . $module . DIRECTORY_SEPARATOR . $contentId . DIRECTORY_SEPARATOR . $filename;
    }
}

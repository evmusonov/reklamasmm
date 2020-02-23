<?php
namespace App\Components;

use App\File;

class FileHelper
{
    public static function deleteFile($directory, $filename) {
        self::deleteDirectory($directory);
        self::deleteFromDb($directory, $filename);
    }

    public static function deleteDirectory($directory)
    {
        $files = array_diff(scandir($directory), ['.','..']);
        foreach ($files as $file) {
            (is_dir("$directory/$file")) ? self::deleteDirectory("$directory/$file") : unlink("$directory/$file");
        }

        return rmdir($directory);
    }

    private static function deleteFromDb($directory, $filename)
    {
        $directoriesArray = explode("/", $directory);
        $directoriesArray = array_reverse($directoriesArray);

        File::where([
            ['content_id', $directoriesArray[0]],
            ['module', $directoriesArray[1]],
            ['filename', $filename]
        ])->delete();
    }
}

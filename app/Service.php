<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $guarded = [];
    public $module = 'service';

    public function getFile($dir = '')
    {
        $image = File::where([
            ['content_id', $this->id],
            ['module', $this->module]
        ])->first();

        if (!empty($dir)) {
            return File::$dir . $this->module . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR .  $dir . DIRECTORY_SEPARATOR . $image->filename;
        }

        return File::$dir . $this->module . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . $image->filename;
    }
}

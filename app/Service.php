<?php

namespace App;

use App\Components\ImgHelper;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $guarded = [];
    public $module = 'service';

    public function getFile()
    {
        $image = File::where([
            ['content_id', $this->id],
            ['module', $this->module]
        ])->first();

        if ($image) {
            return $image;
        }

        return null;
    }

    public function getThumb($dir = '')
    {
        $image = File::where([
            ['content_id', $this->id],
            ['module', $this->module]
        ])->first();

        if ($image) {
            return ImgHelper::getPath($this->module, $dir, $this->id, $image->filename);
        }

        return null;
    }
}

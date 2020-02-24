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
            return ImgHelper::getPath($this->module, '', $this->id, $image->filename);
        }

        return null;
    }
}

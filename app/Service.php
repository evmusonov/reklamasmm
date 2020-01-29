<?php

namespace App;

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
}

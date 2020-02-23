<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $guarded = [];
    public $module = 'review';

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

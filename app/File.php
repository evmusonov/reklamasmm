<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $guarded = [];
    public static $dir = '/storage/app/public/';
}

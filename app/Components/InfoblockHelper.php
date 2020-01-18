<?php
namespace App\Components;


use App\Infoblock;

class InfoblockHelper
{
    public static function get($alias)
    {
        $infoblock = Infoblock::where([
            ['alias', $alias],
            ['status', 1]
        ])->first();
        if ($infoblock) {
            return $infoblock->body;
        }

        return null;
    }
}

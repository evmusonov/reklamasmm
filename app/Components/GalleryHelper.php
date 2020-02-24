<?php
namespace App\Components;

use App\Gallery;

class GalleryHelper
{
    public static function getGallery()
    {
        return view('admin.gallery.template', ['gallery' => Gallery::where('status', 1)->orderBy('weight', 'asc')->get()]);
    }
}

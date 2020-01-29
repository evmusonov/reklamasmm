<?php
namespace App\Components;

use App\Service;

class ServiceHelper
{
    public static function getServices()
    {
        return view('admin.service.template', ['services' => Service::where('status', 1)->orderBy('weight', 'asc')->get()]);
    }
}

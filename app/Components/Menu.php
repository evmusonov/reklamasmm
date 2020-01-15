<?php
namespace App\Components;

use App\Menu as ModelMenu;

class Menu
{
    public static function getMenu()
    {
        return view('admin.menu.template', ['menu' => ModelMenu::where('status', 1)->orderBy('weight', 'asc')->get()]);
    }
}

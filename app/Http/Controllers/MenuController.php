<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('weight', 'asc')->get();

        return view('admin.menu.index', ['menu' => $menu]);
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'link' => 'required|unique:menus',
            'weight' => 'required',
            'status' => 'boolean'
        ]);

        Menu::create($validatedData);

        return redirect('/admin/menu');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', ['menu' => $menu]);
    }

    public function update(Request $request, Menu $menu)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'link' => [
                'required',
                Rule::unique('menus')->ignore($menu->link, 'link'),
            ],
            'weight' => 'required',
            'status' => 'boolean'
        ]);

        $menu->update($validatedData);

        return redirect('/admin/menu');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->delete()) {
            return redirect('/admin/menu')->with('deleteSuccess', 'Запись успешно удалена.');
        }

        return redirect('/admin/menu')->with('deleteFail', 'Ошибка удаления. Обратитесь к администратору.');
    }
}

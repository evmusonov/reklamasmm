<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

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
            'link' => 'required',
            'weight' => 'required',
            'status' => 'boolean'
        ]);

        $exist = Menu::where('title', $validatedData['title'])->first();
        if ($exist) {
            return redirect('/admin/menu/create')->with('exist', 'Пункт меню с таким заголовком уже существует');
        }

        Menu::create($validatedData);

        return redirect('/admin/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', ['menu' => $menu]);
    }

    public function update(Request $request, Menu $menu)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'link' => 'required',
            'weight' => 'required',
            'status' => 'boolean'
        ]);

        $exist = Menu::where([
            ['title', $validatedData['title']],
            ['title', '<>', $menu->title]
        ])->first();
        if ($exist) {
            return redirect("/admin/menu/$menu->id/edit")->with('exist', 'Пункт меню с таким заголовком уже существует');
        }

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

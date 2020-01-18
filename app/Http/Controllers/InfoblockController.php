<?php

namespace App\Http\Controllers;

use App\Infoblock;
use Illuminate\Http\Request;

class InfoblockController extends Controller
{
    public function index()
    {
        $infoblocks = Infoblock::all();

        return view('admin.infoblock.index', ['infoblocks' => $infoblocks]);
    }

    public function create()
    {
        return view('admin.infoblock.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'alias' => 'required',
            'status' => 'boolean'
        ]);

        $exist = Infoblock::where('alias', $validatedData['alias'])->first();
        if ($exist) {
            return redirect('/admin/infoblocks/create')->with('exist', 'Инфоблок с таким алиасом уже существует');
        }

        Infoblock::create($validatedData);

        return redirect('/admin/infoblocks');
    }

    public function edit(Infoblock $infoblock)
    {
        return view('admin.infoblock.edit', ['infoblock' => $infoblock]);
    }

    public function update(Request $request, Infoblock $infoblock)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'alias' => 'required',
            'status' => 'boolean'
        ]);

        $exist = Infoblock::where([
            ['alias', $validatedData['alias']],
            ['alias', '<>', $infoblock->alias]
        ])->first();
        if ($exist) {
            return redirect("/admin/infoblocks/$infoblock->id/edit")->with('exist', 'Инфоблок с таким заголовком уже существует');
        }

        $infoblock->update($validatedData);

        return redirect('/admin/infoblocks');
    }

    public function destroy(Infoblock $infoblock)
    {
        if ($infoblock->delete()) {
            return redirect('/admin/infoblocks')->with('deleteSuccess', 'Запись успешно удалена.');
        }

        return redirect('/admin/infoblocks')->with('deleteFail', 'Ошибка удаления. Обратитесь к администратору.');
    }
}

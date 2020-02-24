<?php

namespace App\Http\Controllers;

use App\Components\FileManager;
use App\File;
use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private $module = 'gallery';

    public function index()
    {
        $gallery = Gallery::orderBy('weight', 'asc')->get();

        return view('admin.gallery.index', ['gallery' => $gallery]);
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
        ]);

        $gallery = Gallery::create($validatedData);

        $uploadManager = new FileManager();
        $imageUploader = $uploadManager->createImageUploder('image');
        $imageUploader->upload($this->module . '/' . $gallery->getAttributes()['id'])->resize(300,false,'thumb');

        return redirect('/admin/gallery');
    }

    public function edit(Gallery $image)
    {
        return view('admin.gallery.edit', ['image' => $image]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
        ]);

        $gallery->update($validatedData);

        $uploadManager = new FileManager();
        $imageUploader = $uploadManager->createImageUploder('image');
        $imageUploader->upload($this->module . '/' . $gallery->id)->resize(300,false,'thumb');

        return redirect('/admin/gallery');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->delete()) {
            return redirect('/admin/gallery')->with('deleteSuccess', 'Запись успешно удалена.');
        }

        return redirect('/admin/gallery')->with('deleteFail', 'Ошибка удаления. Обратитесь к администратору.');
    }
}

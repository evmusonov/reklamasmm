<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    private $imagePath = 'public/service';

    public function index()
    {
        $services = Service::orderBy('weight', 'asc')->get();

        return view('admin.service.index', ['services' => $services]);
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'title' => 'required|unique:services',
            'sub_title' => 'required',
            'body' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
            'price' => 'integer',
            'new' => 'boolean',
            'hit' => 'boolean',
            'sale' => 'boolean',
            'image' => 'required|image|mimetypes:image/jpeg,image/png',
        ]);

        Storage::putFileAs($this->imagePath, $validatedData['image'], $validatedData['image']->getClientOriginalName());

        dump($validatedData); exit;

        Service::create($validatedData);

        return redirect('/admin/services');
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $validatedData = request()->validate([
            'title' => [
                'required',
                Rule::unique('services')->ignore($service->title, 'title'),
            ],
            'sub_title' => 'required',
            'body' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
            'price' => 'integer',
            'new' => 'boolean',
            'hit' => 'boolean',
            'sale' => 'boolean',
        ]);

        $service->update($validatedData);

        return redirect('/admin/services');
    }

    public function destroy(Service $service)
    {
        if ($service->delete()) {
            return redirect('/admin/services')->with('deleteSuccess', 'Запись успешно удалена.');
        }

        return redirect('/admin/services')->with('deleteFail', 'Ошибка удаления. Обратитесь к администратору.');
    }
}

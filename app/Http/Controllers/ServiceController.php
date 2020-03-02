<?php

namespace App\Http\Controllers;

use App\Service;
use Evmusonov\LaravelFileHelper\FileManager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    private $module = 'service';

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
            'title' => 'required',
            'sub_title' => 'string|nullable',
            'body' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
            'price' => 'integer|nullable',
            'new' => 'boolean',
            'hit' => 'boolean',
            'sale' => 'boolean',
        ]);

        $service = Service::create($validatedData);

        $uploadManager = new FileManager();
        $imageUploader = $uploadManager->createImageUploder('image');
        $imageUploader->upload($this->module . '/' . $service->getAttributes()['id'])->resize('200x200');

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
            'sub_title' => 'string|nullable',
            'body' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
            'price' => 'integer|nullable',
            'new' => 'boolean',
            'hit' => 'boolean',
            'sale' => 'boolean',
        ]);

        $service->update($validatedData);

        $uploadManager = new FileManager();
        $imageUploader = $uploadManager->createImageUploder('image');
        $imageUploader->upload($this->module . '/' . $service->id)->resize('200x200');

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

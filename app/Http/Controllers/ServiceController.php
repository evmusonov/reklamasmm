<?php

namespace App\Http\Controllers;

use App\Components\FileHelper;
use App\File;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
            'title' => 'required|unique:services',
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

        $file = new FileHelper($service->getAttributes()['id'], $this->module);
        $file->upload()->resize(400, false, 'thumb',100);

//        if ($image->getError() == 0) {
//            $filename = $image->getClientOriginalName();
//            if (!count(File::where('filename', $filename)->get())) {
//                File::create([
//                    'filename'   => $filename,
//                    'module'     => $this->module,
//                    'content_id' => $service->getAttributes()['id'],
//                ]);
//                Storage::putFileAs($this->imagePath, $image, $filename);
//            }
//        }

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

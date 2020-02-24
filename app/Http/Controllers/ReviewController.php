<?php

namespace App\Http\Controllers;

use App\Components\FileManager;
use App\File;
use App\Review;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    private $module = 'review';

    public function index()
    {
        $reviews = Review::orderBy('weight', 'asc')->get();

        return view('admin.review.index', ['reviews' => $reviews]);
    }

    public function create()
    {
        return view('admin.review.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'author' => 'required',
            'body' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
        ]);

        $review = Review::create($validatedData);

        $uploadManager = new FileManager();
        $imageUploader = $uploadManager->createImageUploder('image');
        $imageUploader->upload($this->module . '/' . $review->id)->resize(200,false,'thumb');

        return redirect('/admin/reviews');
    }

    public function edit(Review $review)
    {
        return view('admin.review.edit', ['review' => $review]);
    }

    public function update(Request $request, Review $review)
    {
        $validatedData = request()->validate([
            'author' => 'required',
            'body' => 'required',
            'weight' => 'required',
            'status' => 'boolean',
        ]);

        $review->update($validatedData);

        $uploadManager = new FileManager();
        $imageUploader = $uploadManager->createImageUploder('image');
        $imageUploader->upload($this->module . '/' . $review->id)->resize(200,false,'thumb');

        return redirect('/admin/reviews');
    }

    public function destroy(Review $review)
    {
        if ($review->delete()) {
            return redirect('/admin/reviews')->with('deleteSuccess', 'Запись успешно удалена.');
        }

        return redirect('/admin/reviews')->with('deleteFail', 'Ошибка удаления. Обратитесь к администратору.');
    }
}

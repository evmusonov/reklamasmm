<?php
namespace App\Components;

use App\Review;

class ReviewHelper
{
    public static function getReviews()
    {
        return view('admin.review.template', ['reviews' => Review::where('status', 1)->orderBy('weight', 'asc')->get()]);
    }
}

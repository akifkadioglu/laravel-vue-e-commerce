<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function deletereview(Request $request)
    {
        Review::where('id', $request->id)->first()->delete();
        return Review::with('user')->with('product')->get();
    }
    public function editedreview(Request $request)
    {
        $review = Review::where('id', $request->id)->first();
        $review->is_active = $request->is_active;
        $review->save();
        return Review::where('id', $request->id)->with('user')->with('product')->first();
    }
    public function editreview(Request $request)
    {
        return Review::where('id', $request->id)->with('user')->with('product')->first();
    }
    public function allreviews()
    {
        return Review::with('user')->with('product')->get();
    }
    public function sendreview(Request $request)
    {
        $request->validate([
            'rate' => ['required', 'min:1', 'max:5'],
            "mytopic" => ['required'],
            "myreview" => ['required']
        ]);
        if (count(Review::where('product_id', $request->product)->where('user_id', $request->user)->get()) == 0) {
            $review = new Review();
            $review->rate = $request->rate;
            $review->subject = $request->mytopic;
            $review->review = $request->myreview;
            $review->user_id = $request->user;
            $review->product_id = $request->product;
            $review->save();
        }
    }
    public function getreviews(Request $request)
    {
        return Review::where('product_id', $request->product_id)->with('user')->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follows()
    {
        return Follows::where('user_id', Auth::user()->id)->with('product')->get();
    }
    public function addfollows()
    {
        if (count(Follows::where('product_id', request()->product_id)->where('user_id', Auth::user()->id)->get()) == 0) {
            $data = new Follows();
            $data->product_id = request()->product_id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return "Bu Ürün beğenilenlere eklendi";
        } else {
            return "Bu Ürün beğenilenlerde var";
        }
    }
    public function unfollows()
    {
        Follows::where('id', request()->id)->first()->delete();
        return Follows::where('user_id', Auth::user()->id)->with('product')->get();
    }
}

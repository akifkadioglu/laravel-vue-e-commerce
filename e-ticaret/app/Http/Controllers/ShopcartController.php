<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Shopcart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopcartController extends Controller
{
    public function deleteshopcart(Request $request)
    {
        Shopcart::where('id', $request->id)->first()->delete();
        return Shopcart::with('user')->with('product')->get();
    }
    public function allshopcarts()
    {
        return Shopcart::with('user')->with('product')->get();
    }
    public function shopcarts()
    {
        return Shopcart::where('user_id', Auth::user()->id)->with('product')->get();
    }
    public function addProduct()
    {
        $product = Products::where('id', request()->id)->first();
        if (count(Shopcart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get()) == 0) {
            $data = new Shopcart();
            $data->product_id = $product->id;
            $data->user_id = Auth::user()->id;
            if (isset(request()->quantity)) {
                $data->quantity = request()->quantity;
            } else {
                $data->quantity = 1;
            }
            $data->save();
            return "{$product->name} ürününü ekledik";
        } else {
            return "{$product->name} zaten var";
        }
    }
    public function deleteProduct()
    {
        Shopcart::where('id', request()->id)->delete();
        return Shopcart::where('user_id', Auth::user()->id)->with('product')->get();
    }
    public function changequantity()
    {
        if (request()->quantity <= 0 || request()->quantity > 10) {
        } else {
            $shopcart = Shopcart::where('id', request()->id)->first();
            $shopcart->quantity = request()->quantity;
            $shopcart->save();
        }
        return Shopcart::where('user_id', Auth::user()->id)->with('product')->get();
    }
}

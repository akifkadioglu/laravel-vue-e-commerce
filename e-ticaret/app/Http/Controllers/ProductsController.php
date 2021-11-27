<?php

namespace App\Http\Controllers;

use App\Models\CategoryProducts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function editedproduct(Request $request)
    {
        $product = Products::where('id', $request->id)->first();


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=1000,height=1000'
        ]);
        $product->image = $request->file('image')->store('productimages', 'public');
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        if (count(Products::where('slug', $product->slug)->get()) > 0) {
            $product->slug = Str::slug($request->name) . "-" . Str::random(10);
        }
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->user_id = $request->user;
        $product->save();

        return Products::with('user')->get();
    }
    public function editproduct(Request $request)
    {
        return Products::where('id', $request->id)->with('user')->first();
    }
    public function createproduct(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=1000,height=1000'
        ]);

        $product = new Products();
        $product->image = $request->file('image')->store('productimages', 'public');
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        if (count(Products::where('slug', $product->slug)->get()) > 0) {
            $product->slug = Str::slug($request->name) . "-" . Str::random(10);
        }
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->user_id = $request->user;
        $product->save();
        return Products::with('user')->get();
    }
    public function deleteproduct(Request $request)
    {
        Products::where('id', $request->id)->first()->delete();
        return Products::with('user')->get();
    }
    public function addproductcategory(Request $request)
    {
        $request->validate([
            'product_id' => ['required '],
            'category_id' => ['required '],
        ]);
        $product_category = CategoryProducts::where("product_id", $request->product_id)->where("category_id", $request->category_id)->get();
        if (count($product_category) == 0) {
            $category = new CategoryProducts();
            $category->product_id = $request->product_id;
            $category->category_id = $request->category_id;
            $category->save();
        }
        return CategoryProducts::where('product_id', $request->product_id)->with('category')->get();
    }
    public function deletecategoryproduct(Request $request)
    {
        CategoryProducts::where('product_id', $request->product_id)->where('category_id', $request->category_id)->first()->delete();
        return CategoryProducts::where('product_id', $request->product_id)->with('category')->get();
    }
    public function getcategories(Request $request)
    {
        return CategoryProducts::where('product_id', $request->id)->with('category')->get();
    }
    public function product()
    {
        return Products::with('user')->get();
    }

    public function productForCategory($array = "x")
    {
        $dizi = explode(",", $array);
        if ($array == "x" || count($dizi) == 0) {
            return Products::all();
        }
        $categories = [];
        $empty_array = [];
        $products = [];

        foreach ($dizi as $key) {
            $category = CategoryProducts::where('category_id', $key)->get();
            foreach ($category as $key) {
                array_push($categories, $key);
            }
        }
        foreach ($categories as $key) {
            if (in_array($key->product_id, $empty_array) != 1) {
                $product = Products::where('id', $key->product_id)->get();

                foreach ($product as $add) {
                    array_push($products, $add);
                }
            }
            array_push($empty_array, $key->product_id);
        }


        return $products;
    }
    public function getProduct($slug)
    {
        return Products::where('slug', $slug)->first();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        return Category::all();
    }
    public function topcategory()
    {
        return Category::where('parent_id', null)->get();
    }
    public function editcategory(Request $request)
    {
        return Category::where('id', $request->id)->first();
    }
    public function subcategory(Request $request)
    {
        return Category::where('parent_id', $request->id)->get();
    }
    public function editedcategory(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->save();
        return Category::where('parent_id', null)->get();
    }


    public function deletecategory(Request $request)
    {
        Category::where('id', $request->id)->first()->delete();
        return Category::where('parent_id', null)->get();
    }
    public function createcategory(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();
        

        return Category::where('parent_id', null)->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use App\Product;

class ItemsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() 
    {
        $data = [];
        $categories = [];

        $categories = Category::all();

        $data['categories'] = $categories;
        return view('categories')->with($data);
    }

    public function category($name)
    {
        $category = Category::where('name', ucfirst($name))->get()->first();
        if (!empty($category)) {
            $category->products = Category::find($category->id)->products;
        }
        return $category;
        $data['category'] = $category;
        return view('category')->with($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Categories;

class ItemsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() 
    {
        $data = [];
        $categories = [];

        $categories = Categories::all();

        $data['categories'] = $categories;
        return view('categories')->with($data);
    }

    public function category($name)
    {

        $category = Categories::where('name', ucfirst($name))->get();

        $data['category'] = $category[0];
        return view('category')->with($data);
    }
}

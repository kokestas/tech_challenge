<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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
            $pagination = $this->paginate($category->products);
            $category->products = $pagination['products'];
            $category->links = $pagination['links'];
        }
        
        $data['category'] = $category;
        return view('category')->with($data);
    }

    public function product($id) 
    {
        $data['product'] = Product::find($category->id)->category;
        return view('category')->with($data);
    }

    protected function paginate($items)
    {
        $perPage = 5;
        $page = Input::get('page', 1); // Get the current page or default to 1
        $request = request();
        $offset = ($page * $perPage) - $perPage;

        $return = [];
        $return['products'] = array_slice($items->toArray(), $offset, $perPage, true);
        $return['links'] = new LengthAwarePaginator(
            array_slice($items->toArray(), $offset, $perPage, true),
            count($items), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return $return;
    }
}

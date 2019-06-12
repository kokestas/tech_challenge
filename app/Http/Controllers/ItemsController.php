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

    function __construct()
    {
        $this->sort_array = [
            'name_asc' => ['by' => 'name', 'val' => 'ASC'],
            'name_desc' => ['by' => 'name', 'val' => 'DESC'],
            'price_asc' => ['by' => 'price', 'val' => 'ASC'],
            'price_desc' => ['by' => 'price', 'val' => 'DESC'],
        ];
    }

    public function index() 
    {
        $data = [];
        $categories = [];

        $categories = Category::all();

        $data['categories'] = $categories;
        return view('categories')->with($data);
    }
    
    public function search() 
    {
        $data = [];
        $search = Input::post('q')?Input::post('q'):'';
        if (empty($search)) {
            return view('result');
        }
        $data['search'] = $search;
        $sort_by = Input::post('sort_by');
        $data['sort_by'] = $sort_by;
        if (!empty($this->sort_array[$sort_by]) && $sort_by !== 'sort_by') {
            $sort_by_arr = $this->sort_array[$sort_by];
        } else {
            $sort_by_arr = ['by' => 'id', 'val'=>'asc'];
        }

        $result = Product::where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        })->orderBy($sort_by_arr['by'],$sort_by_arr['val'])->paginate(5);
        $result->appends(['q' => $search, 'sort_by' => $sort_by]);
        $data['result'] = $result;
        return view('result')->with($data);
    }

    public function category($name)
    {
        $data = [];
        $category = Category::where('name', ucfirst($name))->get()->first();
        
        $sort_by = Input::post('sort_by');
        $data['sort_by'] = $sort_by;
        if (!empty($this->sort_array[$sort_by]) && $sort_by !== 'sort_by') {
            $sort_by_arr = $this->sort_array[$sort_by];
        } else {
            $sort_by_arr = ['by' => 'id', 'val'=>'asc'];
        }

        if (!empty($category)) {
            $category->products = Product::where('category_id', $category->id)->orderBy($sort_by_arr['by'],$sort_by_arr['val'])->paginate(5);
            $category->products->appends(['sort_by' => $sort_by]);
        } else {
            return redirect('/');
        }
        
        $data['category'] = $category;
        return view('category')->with($data);
    }

    public function product($id) 
    {
        if (!is_numeric($id)) {
            return redirect('/');
        }
        $data = [];
        $data['product'] = Product::find($id);
        $data['product']->category = Product::find($id)->category;
  
        return view('product')->with($data);
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

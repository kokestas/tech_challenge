@extends('layout')

@section('content')
    <div class="category-products">
        
        <h3 class="products-sort">
            <span class="back-btn" style="float:left">
                <a href="/" class="btn btn-secondary">Back</a>
            </span>
            <div style="float:left">{{$category->name}}</div>
            <div class="sort-by">
                    <form method="post">
                        @csrf
                        <select name="sort_by" class="custom-select"onchange="this.form.submit()">
                            <option {{(empty($sort_by)?'selected':'')}}>Sort</option>
                            <option {{((!empty($sort_by) && $sort_by==='name_asc')?'selected':'')}} value="name_asc">Name ASC</option>
                            <option {{((!empty($sort_by) && $sort_by==='name_desc')?'selected':'')}} value="name_desc">Name DESC</option>
                            <option {{((!empty($sort_by) && $sort_by==='price_asc')?'selected':'')}} value="price_asc">Price ASC</option>
                            <option {{((!empty($sort_by) && $sort_by==='price_desc')?'selected':'')}} value="price_desc">Price DESC</option>
                        </select>
                    </form>
                </div>
        </h3>
        @if(!empty($category->products))
            {{ $category->products->links() }}
            @foreach ($category->products as $product)
                <div class="card inline">
                    <div class="card-body row">
                        <div class="col-md-6">
                            <img class="card-img-top" src="{{ URL::asset('img/mobile.jpg') }}" alt="Card image">
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><strong>{{$product['name']. ' [$'.$product['price'] . ']'}}</strong></p>
                            <p class="card-text">{{str_limit($product['description'], 100)}}</p>
                            <a href="/product/{{$product['id']}}" class="card-link">More info</a>
                        </div>
                        
                    </div>
                </div>
            @endforeach
            
            <br/><br/>
            {{ $category->products->links() }}
        @else
            There are no items for this category yet.
        @endif
    </div>
@endsection

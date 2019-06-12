@extends('layout')

@section('content')
    <div class="category-products">
        <h3>
            Search results for "{{(!empty($search)?$search:'')}}":
        </h3>
        @if (!empty($result))
            <div class="sort-by">
                <form method="post">
                    @csrf
                    <input type="hidden" name="q" value="{{(!empty($search)?$search:'')}}">
                    <select name="sort_by" class="custom-select"onchange="this.form.submit()">
                        <option {{(empty($sort_by)?'selected':'')}}>Sort</option>
                        <option {{((!empty($sort_by) && $sort_by==='name_asc')?'selected':'')}} value="name_asc">Name ASC</option>
                        <option {{((!empty($sort_by) && $sort_by==='name_desc')?'selected':'')}} value="name_desc">Name DESC</option>
                        <option {{((!empty($sort_by) && $sort_by==='price_asc')?'selected':'')}} value="price_asc">Price ASC</option>
                        <option {{((!empty($sort_by) && $sort_by==='price_desc')?'selected':'')}} value="price_desc">Price DESC</option>
                    </select>
                </form>
            </div>
        
            {{ $result->links()}}
            @foreach ($result as $product)
                <div class="card inline">
                    <div class="card-body row">
                        <div class="col-md-6">
                            <img class="card-img-top" src="{{ URL::asset('img/mobile.jpg') }}" alt="Card image">
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><strong>{{$product['name']. ' [$'.$product['price'] . ']'}}</strong></p>
                            <p class="card-text">{{str_limit($product->description, 100)}}</p>
                            <a href="/product/{{$product['id']}}" class="card-link">More info</a>
                        </div>
                        
                    </div>
                </div>
            @endforeach
            
            <br/><br/>
            {{ $result->links() }}
        @else
            No items found.
        @endif
    </div>
@endsection

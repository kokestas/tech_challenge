@extends('layout')

@section('content')
    <div class="category-products">
        <h3>
            Search results:
        </h3>
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
    </div>
@endsection

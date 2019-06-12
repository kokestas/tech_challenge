@extends('layout')

@section('content')
    <div class="category-products">
        <h3>
            <span class="back-btn">
                <a href="/" class="btn btn-secondary">Back</a>
            </span>
           {{$category->name}}
        </h3>
        {{ $category->links }}
        @foreach ($category->products as $product)
            <div class="card inline">
                 <div class="card-body row">
                    <div class="col-md-6">
                        <img class="card-img-top" src="{{ URL::asset('img/mobile.jpg') }}" alt="Card image">
                    </div>
                    <div class="col-md-6">
                        <p class="card-text"><strong>{{$product['name']. ' [$'.$product['price'] . ']'}}</strong></p>
                        <a href="/product/{{$product['id']}}" class="card-link">More info</a>
                    </div>
                    
                </div>
            </div>
        @endforeach
        
        <br/><br/>
        {{ $category->links }}
    </div>
@endsection

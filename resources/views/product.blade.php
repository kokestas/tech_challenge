@extends('layout')

@section('content')
    <div class="card inline product">
        <div class="card-body row">
            <div class="col-md-4">
                <img class="card-img-top" src="{{ URL::asset('img/mobile.jpg') }}" alt="Card image">
            </div>
            <div class="col-md-6">
                <p class="card-text"><strong>{{$product->name. ' [$'.$product->price . ']'}}</strong></p>
                <p class="card-text">{{$product->description}}</p>
                <p>
                    <a href="/category/{{$product->category->name}}" class="btn btn-secondary">Back</a>
                </p>
            </div>
        </div>
    </div>
@endsection

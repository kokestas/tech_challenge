@extends('layout')

@section('content')
    <div class="card categories-list" style="width: 100%;">
        <div class="card-header">
           {{$category->name}}
        </div>
        @foreach ($category->products as $product)
            {{$product->name}}
        @endforeach
    </div>
@endsection

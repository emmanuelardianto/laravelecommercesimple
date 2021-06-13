@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12 mb-3">
        <a href="{{ route('user.product.byCategory', $product->category) }}">{{ $product->category->name }}</a> > {{ $product->name }}
    </div>
    <div class="col-md-5 col-12">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" title="{{ $product->name }}" class="w-100" />
    </div>
    <div class="col-md-7 col-12">
        <h1 class="my-3">{{ $product->name }}</h1>
        <div class="text-gray fs-3 mb-4">{{ $product->price_with_currency }}</div>
        <p>{{ $product->description }}</p>
        <button class="btn btn-primary btn-lg">Buy Now</button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h2 class="mb-3">Related Product</h2>
    </div>
    @foreach($product->related as $item)
    <div class="col-md-2 col-sm-3 col-6">
        <div class="card">
            <a href="{{ route('user.product.detail', $item) }}">
                <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}" title="{{ $item->name }}" />
            </a>
            <div class="card-body">
                <h5 class="card-title" style="height: 50px; overflow: hidden;">{{ $item->name }}</h5>
                <p class="card-text">{{ $item->price_with_currency }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
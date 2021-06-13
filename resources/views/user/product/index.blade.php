@extends('layout')
@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="my-3">Products</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-4 col-12">
        <h5 class="mb-3">Categories</h5>
        <div class="list-group">
            @foreach($categories as $item)
            <a href="{{ route('user.product.byCategory', $item) }}" class="list-group-item list-group-item-action" aria-current="true">{{ $item->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-lg-9 col-md-8 col-12">
        <div class="row">
            @foreach($products as $item)
            <div class="col-md-4 col-sm-6 col-12 mb-4">
                <div class="card">
                    <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}" title="{{ $item->name }}" />
                    <div class="card-body">
                        <h5 class="card-title" style="height: 50px; overflow: hidden;">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->price_with_currency }}</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
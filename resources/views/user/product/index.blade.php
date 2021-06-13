@extends('layout')
@section('content')
<div class="row py-4">
    <div class="col-lg-3 col-md-4 col-12">
        <div class="list-group">
            @foreach($categories as $item)
            <a href="{{ route('user.product.byCategory', $item) }}" class="list-group-item list-group-item-action {{ isset($category) && $category == $item ? 'active' : '' }}" aria-current="true">{{ $item->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-lg-9 col-md-8 col-12">
        <h1 class="my-3">{{ isset($category) ? $category->name : 'Products' }}</h1>
        <div class="row">
            @foreach($products as $item)
            <div class="col-md-4 col-sm-6 col-12 mb-4">
                <div class="card">
                    <a href="{{ route('user.product.detail', $item) }}">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}" title="{{ $item->name }}" />
                    </a>
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
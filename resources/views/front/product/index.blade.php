@extends('layout')
@section('content')
<div class="row py-4">
    <div class="col-lg-3 col-md-4 col-12">
        <div class="list-group">
            @foreach($categories as $item)
            <a href="{{ route('front.product.byCategory', $item) }}" class="list-group-item list-group-item-action {{ isset($category) && $category == $item ? 'active' : '' }}" aria-current="true">{{ $item->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-lg-9 col-md-8 col-12">
        <h1 class="my-3">{{ isset($category) ? $category->name : 'Products' }}</h1>
        <div class="row mb-3">
            <div class="col-md-4 col-12">
                <div class="form-group">
                    <form action="" id="sortProduct">
                        <select name="order" id="order" class="form-control" onchange="document.getElementById('sortProduct').submit()">
                            <option value="">Sort</option>
                            <option value="priceasc" {{ isset($order) && $order == 'priceasc' ? 'selected' : ''  }}>Low to High Price</option>
                            <option value="pricedesc" {{ isset($order) && $order == 'pricedesc' ? 'selected' : ''  }}>High to Low Price</option>
                            <option value="nameasc" {{ isset($order) && $order == 'nameasc' ? 'selected' : ''  }}>A - Z</option>
                            <option value="namedesc" {{ isset($order) && $order == 'namedesc' ? 'selected' : ''  }}>Z - A</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $item)
            <div class="col-md-4 col-sm-6 col-12 mb-4">
                <div class="card">
                    <a href="{{ route('front.product.detail', $item) }}">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}" title="{{ $item->name }}" />
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" style="height: 50px; overflow: hidden;">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->price_with_currency }}</p>
                        <button class="btn btn-primary" type="button" onclick="event.preventDefault();
                                                    document.getElementById('addcart-form{{ $item->id }}').submit();">Buy Now</button>
                        <form id="addcart-form{{ $item->id }}" action="{{ route('front.transaction.addToCart', $item) }}" method="POST" class="d-none">
                            @csrf
                        </form>
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
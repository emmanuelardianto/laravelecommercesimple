@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Wishlist'])
    </div>
    @if($wishlists->count() == 0)
    <p>Wishlist is empty.</p>
    @endif
    @foreach($wishlists as $item)
    <div class="col-md-3 col-sm-4 col-6 mb-4">
        <div class="card">
            <a href="{{ route('front.product.detail', $item->product) }}">
                <img src="{{ $item->product->image_url }}" class="card-img-top" alt="{{ $item->product->name }}" title="{{ $item->product->name }}" />
            </a>
            <div class="card-body">
                <h5 class="card-title" style="height: 50px; overflow: hidden;">{{ $item->product->name }}</h5>
                <p class="card-text">{{ $item->product->price_with_currency }}</p>
                <a href="#" class="btn btn-primary">Buy Now</a>
                <button class="btn btn-secondary" type="button" onclick="event.preventDefault();
                                    document.getElementById('wishlist-form').submit();">Remove</button>
                <form id="wishlist-form" action="{{ route('front.user.wishlist.remove', $item) }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
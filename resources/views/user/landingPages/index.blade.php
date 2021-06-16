@extends('layout')
@section('banner')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @for($i=0;$i<=4;$i++)
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-current="true" aria-label="{{ 'Slide'.( $i + 1) }}"></button>
        @endfor
    </div>
    <div class="carousel-inner">
        @for($i=0;$i<=4;$i++)
        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
            <img src="http://placehold.jp/D3D3D3/003366/1920x500.png?text=Slide%20{{ $i + 1 }}" class="d-block w-100" alt="{{ 'Slide'.( $i + 1) }}">
        </div>
        @endfor
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-3">Recommendations</h2>
    </div>
    @foreach($products as $item)
        <div class="col-lg-2 col-md-3 col-6 mb-3">
            <div class="card">
                <a href="{{ route('user.product.detail', $item) }}">
                    <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}" title="{{ $item->name }}" />
                </a>
                <div class="card-body">
                    <h5 class="card-title" style="height: 50px; overflow: hidden;">{{ $item->name }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
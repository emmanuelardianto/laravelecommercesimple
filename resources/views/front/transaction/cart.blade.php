@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        <h1 class="mb-3">Shopping Cart</h1>
        @include('components.alert')
        @if(isset($transaction))
            @foreach($transaction->items as $item)
            <p>{{ $item->name }}</p>
            @endforeach
        @else
        <p>Shopping cart is empty.</p>
        @endif
    </div>
</div>
@endsection
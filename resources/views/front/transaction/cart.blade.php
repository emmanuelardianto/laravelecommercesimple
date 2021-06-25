@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        <h1 class="mb-5">Shopping Cart</h1>
        @include('components.alert')
        
        @if(isset($transaction))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="80%">Product</th>
                        <th class="text-center" width="10%">Qty</th>
                        <th class="text-center" width="10%">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->items as $item)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ $item->product->image_url }}" class="w-100" alt="{{ $item->name }}" title="{{ $item->name }}" />
                                </div>
                                <div class="col-10 py-3">
                                    <h5>{{ $item->name }}</h5>
                                    <p>{{ $item->product->description }}</p>
                                    <a href="#" onclick="event.preventDefault();
                                                    document.getElementById('remove-form{{ $item->id }}').submit();">Delete</a>
                                    <form id="remove-form{{ $item->id }}" action="{{ route('front.transaction.removeFromCart', $item) }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" valign="middle">{{ $item->qty }}</td>
                        <td class="text-center" valign="middle">{{ $item->price }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end">Subtotal({{ $transaction->qty }} items): <strong>{{ $transaction->subtotal }}</strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="py-3 text-end">
                <a href="{{ route('front.transaction.selectAddress') }}" class="btn btn-lg btn-primary">Finishing Checkout</a>
            </div>
        @else
        <p>Shopping cart is empty.</p>
        @endif
    </div>
</div>
@endsection
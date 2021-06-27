@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Order History'])
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Placed</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $item)
            <tr>
                <td><a href="{{ route('front.user.transactionDetail', $item) }}" class="text-dark">{{ $item->code }}</a></td>
                <td>{{ $item->order_placed }}</td>
                <td>{{ $item->formattedSubtotal }}</td>
                <td>{{ trans('transaction.status.'.$item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $transactions->links() }}
    </div>
</div>
@endsection
@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Order History'])
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
        <form action="{{ route('front.user.transaction') }}" id="formStatusFilter" method="GET">
            <div class="form-group">
                <select name="status" id="status" class="form-control" onChange="document.getElementById('formStatusFilter').submit()">
                    <option value="" {{ is_null($status) || empty($status) ? 'selected' : '' }}>-- All --</option>
                    @foreach(trans('transaction.status') as $key => $item)
                    <option value="{{ $key }}" {{ isset($status) && $status == $key ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="col-12">
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
</div>
@endsection
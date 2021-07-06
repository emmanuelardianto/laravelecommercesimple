@extends('layout')
@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.transaction') }}" class="py-3 d-block">Back to transaction list</a>
        <h1 class="mb-5">Order #{{ $transaction->code }}</h1>
        @include('components.alert')
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
    </div>
    <div class="col-12 col-md-6">
        <form action="{{ route('admin.transaction.update', $transaction) }}" id="formStatusFilter" method="GET">
            {{ csrf_field() }}
            <div class="row mb-3">
                <label for="status" class="col-auto col-form-label">Change Status</label>
                <div class="col-auto">
                    <select name="status" id="status" class="form-control">
                        @foreach(trans('transaction.status') as $key => $item)
                        <option value="{{ $key }}" {{ $transaction->status == $key ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
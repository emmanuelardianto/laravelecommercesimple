@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        <h1 class="mb-5">Select Payment</h1>
        @include('components.alert')
        <div class="row">
            @foreach($payments as $item)
                <div class="col-lg-3 col-md-4 col-12">
                    <a href="#" onclick="event.preventDefault();
                                                    document.getElementById('selectPayment-form{{ $item['key'] }}').submit();" class="list-group-item list-group-item-action py-3" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $item['name'] }}  </h5>
                        </div>
                    </a>
                    <form id="selectPayment-form{{ $item['key'] }}" action="{{ route('front.transaction.selectPayment', $item) }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="payment" value="{{ $item['key'] }}" />
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
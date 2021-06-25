@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        <h1 class="mb-5">Select Address</h1>
        @include('components.alert')
        <div class="row">
            @foreach($addresses as $address)
                <div class="col-lg-3 col-md-4 col-12">
                    <a href="#" onclick="event.preventDefault();
                                                    document.getElementById('selectAddress-form{{ $address->id }}').submit();" class="list-group-item list-group-item-action py-3" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $address->name }}  </h5>
                            <small>{{ $address->default || $loop->index == 0 ? 'default' : '' }}</small>
                        </div>
                        <small>{{ $address->zip_code }}</small>
                        <p class="mb-1">{{ $address->line1 }}<br />{{ $address->line2 }}</p>
                        <p class="mb-1">{{ $address->city }}, {{ $address->country }}</p>
                        <p class="mb-1">Phone: ({{ $address->phone }})</p>
                    </a>
                    <form id="selectAddress-form{{ $address->id }}" action="{{ route('front.transaction.selectAddress', $address) }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Address'])
    </div>
    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12">
        <div class="list-group">
            @foreach($addresses as $address)
            <a href="{{ route('front.user.address.edit', $address) }}" class="list-group-item list-group-item-action py-3" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $address->name }}  </h5>
                    <small>{{ $address->default || $loop->index == 0 ? 'default' : '' }}</small>
                </div>
                <small>{{ $address->zip_code }}</small>
                <p class="mb-1">{{ $address->line1 }}<br />{{ $address->line2 }}</p>
                <p class="mb-1">{{ $address->city }}, {{ $address->country }}</p>
                <p class="mb-1">Phone: ({{ $address->phone }})</p>
            </a>
            @endforeach
            <a href="{{ route('front.user.address.create') }}" class="list-group-item list-group-item-action text-primary text-center py-3">Add New</a>
        </div>
    </div>
</div>
@endsection
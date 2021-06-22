@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Address'])
    </div>
    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12">
        <form method="POST" action="{{ !isset($address) ? route('front.user.address.store') : route('front.user.address.update', $address) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ isset($address) ? $address->name : old('name') }}" required />
            </div>
            <div class="mb-3">
                <label for="line1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" name="line1" value="{{ isset($address) ? $address->line1 : old('line1') }}" required />
            </div>
            <div class="mb-3">
                <label for="line2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" name="line2" value="{{ isset($address) ? $address->line2 : old('line2') }}" />
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" name="country" value="{{ isset($address) ? $address->country : old('country') }}" required />
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" value="{{ isset($address) ? $address->city : old('city') }}" required />
            </div>
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text" class="form-control" name="zip_code" value="{{ isset($address) ? $address->zip_code : old('zip_code') }}" required />
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ isset($address) ? $address->phone : old('phone') }}" required />
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('front.user.address') }}" class="btn btn-secondary">Cancel</a>
            @if(@isset($address))
            <button class="btn btn-danger" type="button" id="deleteBtn">Delete</button>
            @endif
        </form>
        @if(@isset($address))
        <form method="POST" id="deleteForm" action="{{ route('front.user.address.destroy', $address) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
        </form>
        @endif
    </div>
</div>
@endsection
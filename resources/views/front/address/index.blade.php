@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Address'])

        <a href="{{ route('front.user.address.create') }}">Add New</a>
    </div>
</div>
@endsection
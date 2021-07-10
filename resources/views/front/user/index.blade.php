@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
    @include('front.user.nav', ['header' => 'My Account'])
    </div>
    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12">
        <form action="{{ route('front.user.profile.update') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required />
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
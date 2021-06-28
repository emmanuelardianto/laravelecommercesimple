@extends('layout')
@section('content')
<div class="row mt-1 mb-4">
    <div class="col-12">
        @include('front.user.nav', ['header' => 'Security'])
    </div>
    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12">
        <form action="{{ route('front.user.password.update') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="oldPassword" class="form-label">Old Password</label>
                <input type="password" name="oldPassword" id="oldPassword" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
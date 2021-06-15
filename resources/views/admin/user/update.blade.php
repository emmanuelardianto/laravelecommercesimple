@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        User {{ isset($user) ? 'Update - '.$user->name : 'Create' }}
    </h1>
    @include('components.alert')
    <form method="POST" action="{{ !isset($user) ? route('admin.user.store') : route('admin.user.update', $user) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required />
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required />
        </div>
        @if(!isset($user))
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
        </div>
        @endif
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="is_admin" name="is_admin" {{ isset($user) && $user->is_admin || old('is_admin') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_admin">
                Is Admin
            </label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="status" name="status"  {{ isset($user) && $user->status || old('status') ? 'checked' : '' }}>
            <label class="form-check-label" for="status">
                Is Active
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.user') }}" class="btn btn-secondary">Cancel</a>
        @if(@isset($user))
        <button class="btn btn-danger" type="button" id="deleteBtn">Delete</button>
        @endif
    </form>
    @if(@isset($user))
    <form method="POST" id="deleteForm" action="{{ route('admin.user.destroy', $user) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
    </form>
    @endif
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#deleteBtn').on('click', function(e) {
        e.preventDefault();
        if(confirm('Are you sure want to delete this data?'))
            $('#deleteForm').submit();
    })
</script>
@endsection
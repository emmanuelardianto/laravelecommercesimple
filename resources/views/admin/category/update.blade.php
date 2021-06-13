@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        Categories {{ isset($category) ? 'Update' : 'Create' }}
    </h1>
    @include('components.alert')
    <form method="POST" action="{{ !isset($category) ? route('admin.category.store') : route('admin.category.update', $category) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ isset($category) ? $category->name : old('name') }}" required />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.category') }}" class="btn btn-secondary">Cancel</a>
        @if(@isset($category))
        <button class="btn btn-danger" type="button" id="deleteBtn">Delete</button>
        @endif
    </form>
    @if(@isset($category))
    <form method="POST" id="deleteForm" action="{{ route('admin.category.destroy', $category) }}" enctype="multipart/form-data">
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
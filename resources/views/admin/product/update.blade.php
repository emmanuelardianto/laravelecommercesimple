@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        Product {{ isset($product) ? 'Update - '.$product->name : 'Create' }}
    </h1>
    @include('components.alert')
    <form method="POST" action="{{ !isset($product) ? route('admin.product.store') : route('admin.product.update', $product) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $item)
                <option value="{{ $item->id }}" {{ isset($product) && $product->category_id == $item->id || old('category_id') == $item->id ? 'selected=selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ isset($product) ? $product->name : old('name') }}" required />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" cols="30" rows="10" class="form-control">{{ isset($product) ? $product->description : old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <div class="form-check">
                <input class="form-check-input" id="statusRadio1" type="radio" 
                    name="status" value="0" {{ isset($product) && $product->status == 0 || old('status') == 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="statusRadio1">
                    Unpublish
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" id="statusRadio2" type="radio" 
                name="status" value="1" {{ isset($product) && $product->status == 1 || old('status') == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="statusRadio2">
                    Publish
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="{{ isset($product) ? $product->price : old('price') }}" required />
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Picture</label>
            <div class="mb-2">
                <img src="{{ isset($product) ? $product->image_url : 'http://placehold.jp/150x150.png' }}" id="imagePreview" alt="Product Image" title="Product Image" width="150px" />
            </div>
            <input type="file" name="image" id="imageInput" class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.product') }}" class="btn btn-secondary">Cancel</a>
        @if(@isset($product))
        <button class="btn btn-danger" type="button" id="deleteBtn">Delete</button>
        @endif
    </form>
    @if(@isset($product))
    <form method="POST" id="deleteForm" action="{{ route('admin.product.destroy', $product) }}" enctype="multipart/form-data">
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

    $('#imageInput').on('change', function() {
        const file = this.files;
        if(file) {
            $('#imagePreview').attr('src', URL.createObjectURL(file[0]));
        }
    });
</script>
@endsection
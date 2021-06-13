@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        Products
        <span class="float-end">
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create</a>
        </span>
    </h1>
    @include('components.alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
            <tr>
                <td><a href="{{ route('admin.product.edit', $item) }}" class="text-dark">{{ $item->name }}</a></td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->status ? 'Publish' : 'Unpublish' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
</div>
@endsection
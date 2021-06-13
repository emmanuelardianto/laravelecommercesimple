@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        Categories
        <span class="float-end">
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create</a>
        </span>
    </h1>
    @include('components.alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $item)
            <tr>
                <td><a href="{{ route('admin.category.edit', $item) }}" class="text-dark">{{ $item->name }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $categories->links() }}
    </div>
</div>
@endsection
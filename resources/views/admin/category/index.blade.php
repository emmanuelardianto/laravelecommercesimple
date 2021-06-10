@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">Categories</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $item)
            <tr>
                <td>{{ $item->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $categories->links() }}
    </div>
</div>
@endsection
@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        User
        <span class="float-end">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Create</a>
        </span>
    </h1>
    @include('components.alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
            <tr>
                <td><a href="{{ route('admin.user.edit', $item) }}" class="text-dark">{{ $item->email }}</a></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->is_admin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $users->links() }}
    </div>
</div>
@endsection
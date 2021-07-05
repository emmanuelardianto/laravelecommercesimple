@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        Transaction
    </h1>
    @include('components.alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $item)
            <tr>
                <td><a href="#" class="text-dark">{{ $item->code }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $transactions->links() }}
    </div>
</div>
@endsection
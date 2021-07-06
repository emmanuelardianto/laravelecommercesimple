@extends('layout')
@section('content')
<div class="col-12">
    <h1 class="my-3">
        Transaction
    </h1>
    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
        <form action="{{ route('admin.transaction') }}" id="formStatusFilter" method="GET">
            <div class="form-group">
                <select name="status" id="status" class="form-control" onChange="document.getElementById('formStatusFilter').submit()">
                    <option value="" {{ is_null($status) || empty($status) ? 'selected' : '' }}>-- All --</option>
                    @foreach(trans('transaction.status') as $key => $item)
                    <option value="{{ $key }}" {{ isset($status) && $status == $key ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    @include('components.alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Summary</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $item)
            <tr>
                <td><a href="{{ route('admin.transaction.detail', $item)}}" class="text-dark">{{ $item->code }}</a></td>
                <td>{{ $item->transaction_summary }}</td>
                <td>{{ trans('transaction.status.'.$item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $transactions->links() }}
    </div>
</div>
@endsection
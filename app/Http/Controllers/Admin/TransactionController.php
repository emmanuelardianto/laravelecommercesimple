<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $transactions = Transaction::orderBy('updated_at', 'desc');
        $search = $request->get('search');
        if(!is_null($search)) {
            $transactions = $transactions->where('name', 'like', '%'.$search.'%');
        }
        $status = $request->get('status');
        if(!is_null($status)) {
            $transactions = $transactions->where('status', $status);
        }
        $transactions = $transactions->paginate(20);
        return view('admin.transaction.index', compact('transactions', 'search', 'status'));
    }

    public function detail(Transaction $transaction) {
        return view('admin.transaction.update', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction) {
        $transaction->status = $request->get('status');
        $transaction->save();
        return redirect()->route('admin.transaction.detail', compact('transaction'))->with('success', 'Data saved.');
    }
}

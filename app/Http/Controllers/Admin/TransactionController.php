<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $transactions = Transaction::orderBy('updated_at', 'desc');
        if(!is_null($search)) {
            $transactions = $transactions->where('name', 'like', '%'.$search.'%');
        }
        $transactions = $transactions->paginate(20);
        return view('admin.transaction.index', compact('transactions', 'search'));
    }
}

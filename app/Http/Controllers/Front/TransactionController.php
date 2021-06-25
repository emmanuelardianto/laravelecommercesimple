<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = null;
        if(Auth::check()) {
            $transaction = Auth::user()->cart;
        }
        return view('front.transaction.cart', compact('transaction'));
    }

    public function addToCart(Product $product) {
        Transaction::addToCart($product);
        return redirect()->route('front.transaction.cart')->with('success', 'Product added to cart.');
    }

    public function removeFromCart(TransactionItem $transactionItem) {
        Transaction::removeFromCart($transactionItem);
        return redirect()->route('front.transaction.cart')->with('success', 'Product removed from cart.');
    }

    public function address() {
        if(!Auth::check())
            return redirect()->route('login');

        if(is_null(Auth::user()->cart))
            return redirect()->route('login');

        $addresses = Address::where('user_id', Auth::user()->id)->orderBy('default', 'desc')->get();
        return view('front.transaction.address', compact('addresses'));
    }

    public function selectAddress(Address $address) {
        if(!Auth::check())
            return redirect()->route('login');

        if(is_null(Auth::user()->cart))
            return redirect()->route('login');

        $cart = Auth::user()->cart;

        $cart->address = $address->line1;
        $cart->save();

        return redirect()->route('front.transaction.payment');
    }

    public function payment() {
        return view('front.transaction.payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

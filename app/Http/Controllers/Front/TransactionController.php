<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index()
    {
        $transaction = $this->user->cart;
        return view('front.transaction.cart', compact('transaction'));
    }

    public function addToCart(Product $product) {
        Transaction::addToCart($product);
        return redirect()->route('front.transaction.cart')->with('success', 'Product added to cart.');
    }

    public function updateQty(TransactionItem $transactionItem, Request $request) {
        $transactionItem->qty = $request->get('qty');
        $transactionItem->save();
        return redirect()->route('front.transaction.cart')->with('success', 'Cart updated.');
    }

    public function removeFromCart(TransactionItem $transactionItem) {
        Transaction::removeFromCart($transactionItem);
        return redirect()->route('front.transaction.cart')->with('success', 'Product removed from cart.');
    }

    public function address() {

        $addresses = Address::where('user_id', $this->user->id)->orderBy('default', 'desc')->get();
        return view('front.transaction.address', compact('addresses'));
    }

    public function selectAddress(Address $address) {
        $cart = $this->user->cart;

        $cart->address = $address->line1;
        $cart->save();

        return redirect()->route('front.transaction.payment');
    }

    public function payment() {
        $payments = config('payment');
        return view('front.transaction.payment', compact('payments'));
    }

    public function selectPayment(Request $request) {
        $cart = $this->user->cart;

        $cart->payment = $request->get('payment');
        $cart->save();

        return redirect()->route('front.transaction.finalize');
    }


    public function finalize() {
        $transaction = $this->user->cart;

        return view('front.transaction.finalize', compact('transaction'));
    }

    public function placeOrder(Request $request) {
        $transaction = $this->user->cart;

        $transaction->status = Transaction::WAITING_FOR_PAYMENT;
        $transaction->save();

        return redirect()->route('front.transaction.thankYou', $transaction)->with('success', 'Order succesfully placed.');
    }

    public function thankYou(Transaction $transaction) {
        return view('front.transaction.thankYou', compact('transaction'));
    }
}

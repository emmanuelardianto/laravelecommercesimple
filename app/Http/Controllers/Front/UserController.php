<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Transaction;
use Auth;
use Hash;
use Illuminate\Contracts\Auth\Guard;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index() {
        return view('front.user.index');
    }

    public function wishlist() {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('front.user.wishlist', compact('wishlists'));
    }

    public function addWishlist(Request $request) {
        $request->validate([
            'product_id' => 'required'
        ]);

        if(Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->get('product_id'))->count() == 0) {
            Wishlist::create([
                'product_id' => $request->get('product_id'),
                'user_id' => Auth::user()->id,
            ]);
        }

        return redirect()->route('front.user.wishlist')->with('success', 'Product added to wishlist.');
    }

    public function removeWishlist(Wishlist $wishlist) {
        $wishlist->delete();
        
        return redirect()->route('front.user.wishlist')->with('success', 'Product removed from wishlist.');
    }

    public function transaction(Request $request) {
        $status = $request->get('status');
        $transactions = Transaction::where('user_id', Auth::user()->id);
        if(!is_null($status))
            $transactions = $transactions->where('status', $status);

        $transactions = $transactions->orderBy('updated_at', 'desc')->paginate(10);

        return view('front.user.transaction', compact('transactions', 'status'));
    }

    public function transactionDetail(Transaction $transaction) {
        return view('front.user.transactionDetail', compact('transaction'));
    }

    public function password() {
        return view('front.user.changePassword');
    }

    public function passwordUpdate(Request $request) {
        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if(!Hash::check($request->get('oldPassword'), $this->user->password))
            return redirect()->back()->with('error', 'Password doesn\'t match.');

        $this->user->password = Hash::make($request->get('password'));
        $this->user->save();

        return redirect()->route('front.user.password')->with('success', 'Succesfully change your password.');
    }

}

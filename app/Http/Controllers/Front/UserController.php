<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;

class UserController extends Controller
{
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

        if(!Auth::check())
            return redirect()->route('login');

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

}

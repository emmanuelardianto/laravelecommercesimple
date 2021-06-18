<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class LandingPageController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->take(6)->get();

        return view('front.landingPages.index', compact('products'));
    }
}

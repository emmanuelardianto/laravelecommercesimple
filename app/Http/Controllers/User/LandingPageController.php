<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class LandingPageController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->take(6)->get();

        return view('user.landingPages.index', compact('products'));
    }
}

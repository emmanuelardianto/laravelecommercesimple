<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::where('status', 1)->paginate(24);
        $categories = Category::orderBy('name')->get();

        return view('user.product.index', compact('products', 'categories'));
    }

    public function byCategory(Request $request, Category $category) {
        $products = $category->products;

        $categories = Category::orderBy('name')->get();

        return view('user.product.index', compact('products', 'category', 'categories'));
    }

    public function show(Product $product) {
        return view('user.product.detail', compact('product'));
    }
}

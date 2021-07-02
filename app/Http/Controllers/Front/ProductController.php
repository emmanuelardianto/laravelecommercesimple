<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Cookie;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::where('status', 1)->paginate(24);
        $categories = Category::orderBy('name')->get();

        return view('front.product.index', compact('products', 'categories'));
    }

    public function byCategory(Request $request, Category $category) {
        $products = Product::where('category_id', $category->id);

        $search = $request->get('search');
        if(!empty($search))
            $products = $products->where('name', 'like', '%'.$search.'%');

        $order = $request->get('order');
        switch ($order) {
            case 'priceasc':
                $products = $products->orderBy('price');
                break;
            case 'pricedesc':
                $products = $products->orderBy('price', 'desc');
                break;
            case 'nameasc':
                $products = $products->orderBy('name');
                break;
            case 'namedesc':
                $products = $products->orderBy('name', 'desc');
                break;
            
            default:
                # code...
                break;
        }
            

        $products = $products->paginate(24);

        $categories = Category::orderBy('name')->get();

        return view('front.product.index', compact('products', 'category', 'categories', 'search', 'order'));
    }

    public function show(Product $product) {
        $productCookie = Cookie::get('product');
        if(is_null($productCookie)) {
            $productCookie = [$product->id];
        } else {
            $productCookie = json_decode($productCookie);
            array_unshift($productCookie, $product->id);
            array_slice(array_unique($productCookie), 0, 10);
        }
        $browsingHistory = Product::whereIn('id', $productCookie)->get();
        Cookie::queue('product', json_encode($productCookie), 60 * 24 * 30);
        return view('front.product.detail', compact('product', 'browsingHistory'));
    }
}

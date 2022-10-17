<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::inRandomOrder()->take(6)->get();
        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function show($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.show', [
            'product' => $product,
        ]);
    }
}

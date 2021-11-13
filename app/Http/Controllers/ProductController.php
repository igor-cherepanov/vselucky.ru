<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request, Category $category)
    {
        $products = Product::all();
        return view('site.products.index', compact('products'));
    }

    public function show(Request $request, Product $product)
    {
        return view('site.products.show', compact('product'));
    }

}

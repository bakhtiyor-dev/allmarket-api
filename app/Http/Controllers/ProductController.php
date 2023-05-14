<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('index', [
            'products' => Product::query()->paginate(20),
            'categories' => Category::all()
        ]);
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }
}

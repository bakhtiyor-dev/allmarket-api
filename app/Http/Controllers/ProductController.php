<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('index', [
            'products' => Product::query()->paginate(20),
            'categories' => Category::all()
        ]);
    }

    public function filter(Request $request)
    {
        $category = Category::query()->find($request->input('category'));

        $products = Product::query()->filter($request->all())->paginate(16);

        return view('product.index', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        return Product::query()->where('title', 'like', "%{$query}%")
            ->get();

    }
}

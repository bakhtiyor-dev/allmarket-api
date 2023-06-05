<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Promise\RejectionException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $recommendations = \Laracombee::recommendItemsToUser(auth()->id(), 5)->wait();

            $recommendations = Product::query()
                ->whereIn('id', \Arr::flatten($recommendations['recomms']))
                ->get();
        }

        return view('index', [
            'recommendations' => $recommendations ?? [],
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
            'category' => $category,
            'categories' => Category::all()
        ]);
    }

    public function show(Product $product)
    {
        if (auth()->check()) {
            try {
                $addDetailView = \Laracombee::addDetailView(auth()->id(), $product->id);
                \Laracombee::send($addDetailView)->wait();
            } catch (RejectionException $exception) {

            }
        }

        $similarProducts = Product::query()
            ->whereNot('shop_id', $product->shop_id)
            ->where('brand_id', $product->brand_id)
            ->where('category_id', $product->category_id)
            ->where('title', 'like', "%{$product->title}%")
            ->get();

        return view('product.show', compact('product', 'similarProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        return Product::query()->where('title', 'like', "%{$query}%")
            ->get();

    }

    public function rate(Product $product, Request $request)
    {
        $product->rate($request->input('rate'));

        return back();
    }
}

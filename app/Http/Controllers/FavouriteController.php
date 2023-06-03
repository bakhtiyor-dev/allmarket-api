<?php

namespace App\Http\Controllers;

use App\Models\Product;
use PHPUnit\Exception;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourites = auth()->user()->favourites()->paginate(15);

        return view('user.favourites', compact('favourites'));
    }

    public function store(Product $product)
    {
        auth()->user()->favourites()->attach($product);

        if (auth()->check()) {
            try {
                $addDetailView = \Laracombee::addBookmark(auth()->id(), $product->id);
                \Laracombee::send($addDetailView)->wait();
            } catch (Exception $exception) {

            }

        }

        return back();
    }

    public function destroy(Product $product)
    {
        auth()->user()->favourites()->detach($product);

        return back();
    }


}

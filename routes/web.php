<?php

use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ParseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/admin', '/admin/brands');
Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/products', [ProductController::class, 'filter'])->name('product.filter');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [ProductController::class, 'search']);

Route::middleware('auth')->group(function () {
    Route::get('/favourites', [FavouriteController::class, 'index']);
    Route::post('/favourites/{product}', [FavouriteController::class, 'store']);
    Route::delete('/favourites/{product}', [FavouriteController::class, 'destroy']);
    Route::post('/products/{product}', [ProductController::class, 'rate'])->name('product.rate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/spiders/{spider}', [ParseController::class, 'runSpider'])->name('spiders.run');
});

require __DIR__ . '/auth.php';

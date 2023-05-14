<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Spider;
use App\Spiders\ProductSpider;
use Illuminate\Support\Facades\Route;
use RoachPHP\Roach;
use RoachPHP\Spider\Configuration\Overrides;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/import', function () {
    $spider = Spider::query()->first();

    Roach::startSpider(
        ProductSpider::class,
        overrides: new Overrides(startUrls: [$spider->shop->url]),
        context: [
            'filter' => $spider->product_filter,
            'shop_id' => $spider->shop->id
        ]);
});

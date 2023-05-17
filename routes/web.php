<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Jobs\ProductParserJob;
use App\Models\Spider;
use App\Spiders\LinkSpider;
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

    Route::get('/spiders/{spider}', function (Spider $spider) {

        $links = Roach::collectSpider(
            LinkSpider::class,
            new Overrides(startUrls: [$spider->shop->url]),
            ['link_filter' => $spider->product_filter->shop_link]
        );


        foreach ($links as $link) {
            echo $link->get('link');
            ProductParserJob::dispatch($link->get('link'), $spider);
        }

        return redirect('/jobs');

    })->name('spiders.run');
});

Route::get('/test', function () {
    $spider = \App\Models\Spider::all()[1];

    Roach::collectSpider(
        ProductSpider::class,
        overrides: new Overrides(startUrls: ['https://ultrashop.uz/ru/store/kompyuternaya-tehnika/noutbuki/23825-acer-aspire-vero-av15-51-7617-nx-aycaa-006-15-6-full-hd-1920x1080-core-i7-1195g7-16-gb-512-gb-ssd']),
        context: [
            'filter' => $spider->product_filter,
            'shop_id' => $spider->shop->id
        ]);


});
require __DIR__ . '/auth.php';

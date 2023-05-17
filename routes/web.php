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

        echo $spider->shop->url . '<br>';
        echo $spider->product_filter->shop_link;
        dd($links);

        foreach ($links as $link) {
            echo $link->get('link');
            ProductParserJob::dispatch($link->get('link'), $spider);
        }

//        return redirect('/jobs');

    })->name('spiders.run');
});

Route::get('/test', function () {
    $res = Http::get('https://openshop.uz');
    dd($res->body());
    return $res->body();
});
require __DIR__ . '/auth.php';

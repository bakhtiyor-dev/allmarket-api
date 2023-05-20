<?php

namespace App\Http\Controllers;

use App\Jobs\ProductParserJob;
use App\Models\Spider;
use App\Spiders\LinkSpider;
use RoachPHP\Roach;
use RoachPHP\Spider\Configuration\Overrides;

class ParseController extends Controller
{
    public function runSpider(Spider $spider)
    {
        $links = Roach::collectSpider(
            LinkSpider::class,
            new Overrides(startUrls: [$spider->shop->url]),
            ['link_filter' => $spider->product_filter->shop_link]
        );

        foreach ($links as $link) {
            ProductParserJob::dispatch($link->get('link'), $spider);
        }

        return back();
    }
}

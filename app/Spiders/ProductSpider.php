<?php

namespace App\Spiders;

use App\Processors\ProductItemProcessor;
use Generator;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;

class ProductSpider extends BasicSpider
{
    public array $startUrls = [];

    public array $itemProcessors = [
        ProductItemProcessor::class
    ];

    public function parse(Response $response): Generator
    {
        try {
            $productFilter = $this->context['filter'];
            $title = $response->filter($productFilter->title)->text();
            $image = $response->filter($productFilter->image)->attr('src');
            $price = $response->filter($productFilter->price)->text();
            $shop = $this->context['shop_id'];
            $brand = $response->filter($productFilter->brand)->text();
            $category = $response->filter($productFilter->category)->text();
            $link = $response->getUri();

            yield $this->item(compact('title', 'image', 'price', 'shop', 'brand', 'category', 'link'));

        } catch (\Exception $exception) {

        }
    }
}

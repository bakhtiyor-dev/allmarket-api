<?php

namespace App\Spiders;

use App\Processors\ProductItemProcessor;
use Generator;
use InvalidArgumentException;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class ProductSpider extends BasicSpider
{
    public array $startUrls = [];

    public array $itemProcessors = [
        ProductItemProcessor::class
    ];

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $productFilter = $this->context['filter'];
        $links = $response->filter($productFilter->shop_link)->links();

        foreach ($links as $link) {
            yield $this->request('GET', $link->getUri(), 'parseItem');
        }
    }

    public function parseItem(Response $response)
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

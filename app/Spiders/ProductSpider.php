<?php

namespace App\Spiders;

use App\Processors\ProductItemProcessor;
use Generator;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use Symfony\Component\DomCrawler\Crawler;

class ProductSpider extends BasicSpider
{
    public array $startUrls = [
        "https://openshop.uz/shop/subsubcategory/xiaomi"
    ];

    public array $itemProcessors = [
        ProductItemProcessor::class
    ];

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        foreach ($response->filter('.product-name') as $item) {
            yield $this->item([
                'title' => (new Crawler($item))->text()
            ]);
        }
    }
}

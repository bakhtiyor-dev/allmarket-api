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
        $shop = $this->context['shop'];

        $links = $response->filter($shop->linkSelector)->links();

        try {
            yield $this->item([
                'title' => $response->filter($shop->titleSelector)->text(),
                'price' => $response->filter($shop->priceSelector)->text(),
                'link' => $response->getUri()
            ]);;
        } catch (InvalidArgumentException $exception) {
            foreach ($links as $link) {
                yield $this->request('GET', $link->getUri());
            }
        }
    }
}

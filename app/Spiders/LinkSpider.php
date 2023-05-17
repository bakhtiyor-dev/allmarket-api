<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;

class LinkSpider extends BasicSpider
{
    public array $startUrls = [];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public function parse(Response $response): Generator
    {
        $links = $response->filter($this->context['link_filter'])->links();

        foreach ($links as $link) {
            yield $this->item([
                'link' => $link->getUri()
            ]);
        }
    }
}

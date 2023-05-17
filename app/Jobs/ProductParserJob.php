<?php

namespace App\Jobs;

use App\Models\Spider;
use App\Spiders\ProductSpider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use RoachPHP\Roach;
use RoachPHP\Spider\Configuration\Overrides;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class ProductParserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use IsMonitored;

    /**
     * Create a new job instance.
     */
    public function __construct(protected string $productUrl, protected Spider $spider)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Roach::startSpider(
            ProductSpider::class,
            overrides: new Overrides(startUrls: [$this->productUrl]),
            context: [
                'filter' => $this->spider->product_filter,
                'shop_id' => $this->spider->shop->id
            ]);
        Roach::startSpider(ProductSpider::class,);
    }
}

<?php

namespace App\Processors;

use App\Models\Product;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;

class ProductItemProcessor implements ItemProcessorInterface
{
    public function configure(array $options): void
    {
        // TODO: Implement configure() method.
    }

    public function processItem(ItemInterface $item): ItemInterface
    {
        Product::query()->create([
            'title' => $item->get('title'),
            'price' => 0,
            'shop_link' => 'asd'
        ]);

        return $item;
    }
}

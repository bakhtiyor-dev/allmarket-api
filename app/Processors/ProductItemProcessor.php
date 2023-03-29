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
            'price' => (int)filter_var($item->get('price'), FILTER_SANITIZE_NUMBER_INT),
            'shop_link' => $item->get('link')
        ]);

        return $item;
    }
}

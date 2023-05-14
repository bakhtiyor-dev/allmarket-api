<?php

namespace App\Processors;

use App\Models\Brand;
use App\Models\Category;
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
        Product::query()->updateOrCreate(
            ['title' => $item->get('title')],
            [
                'price' => (int)filter_var($item->get('price'), FILTER_SANITIZE_NUMBER_INT),
                'shop_link' => $item->get('link'),
                'category_id' => Category::query()->firstOrCreate(['title' => $item->get('category')])->id,
                'shop_id' => $item->get('shop'),
                'brand_id' => Brand::query()->firstOrCreate(['title' => $item->get('brand')])->id,
                'image' => $item->get('image')
                // 'description' => $item->get('description')
            ]
        );

        return $item;
    }
}

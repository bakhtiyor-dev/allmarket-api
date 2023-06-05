<?php

namespace App\Filters;

class ProductFilter extends AbstractFilter
{
    public function category($categoryId): void
    {
        if ($categoryId)
            $this->query->where('category_id', $categoryId);
    }

    public function price(array $priceInterval): void
    {

        if ($priceInterval[0]) {
            $this->query->where('price', '>=', (float)$priceInterval[0]);
        }

        if ($priceInterval[1]) {
            $this->query->where('price', '<=', (float)$priceInterval[1]);
        }
    }

    public function brands(array $brands): void
    {
        foreach ($brands as $brandId) {
            if ($brandId) {
                $this->query->where('brand_id', $brandId);
            }
        }
    }

}

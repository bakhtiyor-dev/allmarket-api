<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class ShopSelector extends Data
{
    public function __construct(
        public string $linkSelector,
        public string $titleSelector,
        public string $imageSelector,
        public string $descriptionSelector,
        public string $priceSelector
    )
    {
    }
}

<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function save(array $payload)
    {
        // TODO: Implement save() method.
    }

    public function upsert(array $upsertPayload)
    {
        Product::query()->updateOrCreate($upsertPayload);
    }
}

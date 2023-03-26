<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function save(array $payload);

    public function upsert(array $upsertPayload);
}

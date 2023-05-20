<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    public function __construct(protected Builder $query)
    {
    }

    public function apply(array $filters): void
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, $key))
                $this->{$key}($value);
        }
    }
}

<?php

namespace App\Models;

use App\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use willvincent\Rateable\Rateable;

class Product extends Model
{
    use Rateable;

    protected $guarded = [];

    public static array $laracombee = ['id' => 'int', 'title' => 'string'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeFilter(Builder $builder, array $filters): void
    {
        (new ProductFilter($builder))->apply($filters);
    }
}

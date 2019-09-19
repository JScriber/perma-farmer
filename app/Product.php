<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product.
 * @package App
 */
class Product extends Model
{

    public $timestamps = false;

    /**
     * Related {@link Basket}.
     * @return BelongsTo
     */
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    /**
     * Product type.
     * @return BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
}

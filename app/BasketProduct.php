<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasketProduct extends Model
{

    public $timestamps = false;

    protected $fillable = ['quantity'];

    /**
     * Baskets that owns the basket product.
     * @return BelongsTo
     */
    public function basket()
    {
        return $this->belongsTo(Basket::class, 'basket_id');
    }

    /**
     * Product associated
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

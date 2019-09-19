<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BasketProduct. Association betwen basket and product.
 * @package App
 */
class BasketProduct extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity'];

    /**
     * {@link Basket} which owns the {@link BasketProduct}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function basket()
    {
        return $this->belongsTo(Basket::class, 'basket_id');
    }

    /**
     * {@link Product} associated.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'weight', 'quantity', 'reserved_quantity');

    /**
     * Related {@link Basket baskets}.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class);
    }
}

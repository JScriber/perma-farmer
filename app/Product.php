<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product.
 * @package App
 */
class Product extends Model
{

    public $timestamps = false;

    protected $fillable = array('name', 'weight', 'quantity');

    /**
     * Product type.
     * @return HasMany
     */
    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class);
    }
}

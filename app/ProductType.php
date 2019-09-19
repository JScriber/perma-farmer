<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'weight');

    /**
     * Associates products.
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

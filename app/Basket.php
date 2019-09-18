<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'order_date', 'user_subscription_id', 'crate_id'];

    /**
     * {@link BasketProduct} in the {@link Basket}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'basket_product', 'basket_id', 'product_id');
    }

    /**
     * {@link Basket} owner.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userSubscription()
    {
        return $this->belongsTo(UserSubscription::class);
    }

    /**
     * {@link Basket} container.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function crate()
    {
        return $this->belongsTo(Crate::class);
    }
}

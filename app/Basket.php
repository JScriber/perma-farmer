<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Basket extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['validated', 'order_date', 'user_subscription_id', 'crate_id'];

    /**
     * {@link BasketProduct BasketProducts} in the {@link Basket}.
     * @return HasMany
     */
    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class);
    }

    /**
     * Client.
     * @return BelongsTo
     */
    public function userSubscription()
    {
        return $this->belongsTo(UserSubscription::class, 'user_subscription_id', 'basket_id');
    }

    /**
     * {@link Basket} container.
     * @return BelongsTo
     */
    public function crate()
    {
        return $this->belongsTo(Crate::class);
    }
}

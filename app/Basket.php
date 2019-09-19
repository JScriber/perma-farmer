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
     * {@link Product Products} in the {@link Basket}.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
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

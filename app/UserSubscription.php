<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UserSubscription
 * @package App
 */
class UserSubscription extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pro_account', 'basket_id'];

    /**
     * Bag owned by the {@link Client}.
     * @return HasMany
     */
    public function bags()
    {
        return $this->hasMany(Bag::class);
    }

    /**
     * Chosen account {@link Subscription}.
     * @return BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * {@link User} who has the {@link Subscription}.
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Basket.
     * @return HasOne
     */
    public function basket()
    {
        return $this->hasOne(Basket::class, 'user_subscription_id', 'basket_id');
    }
}

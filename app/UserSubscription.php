<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['pro_account'];

    /**
     * {@link Basket} made by the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }

    /**
     * Bag owned by the {@link Client}.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bags()
    {
        return $this->hasMany(Bag::class);
    }

    /**
     * Chosen account {@link Subscription}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * {@link User} who has the {@link Subscription}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

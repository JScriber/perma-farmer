<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSubscription extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subscription_id', 'client_id', 'bag_id'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bag()
    {
        return $this->hasOne(Bag::class);
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
     * {@link Client} who has the {@link Subscription}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
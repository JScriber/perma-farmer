<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'password', 'email_address', 'pro_account'];

    /**
     * {@link Subscription Subscriptions} of the {@link Client}.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientSubscriptions()
    {
        return $this->hasMany(ClientSubscription::class);
    }

    /**
     * Payment credit card.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }
}

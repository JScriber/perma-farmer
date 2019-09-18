<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'password', 'email', 'pro_account', 'credit_card_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * {@link Subscription Subscriptions} of the {@link Client}.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
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

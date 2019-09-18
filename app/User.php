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
        'firstname', 'lastname', 'password', 'email', 'credit_card_id', 'role_id'
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
     * Role.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }

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
        return $this->hasOne(CreditCard::class, 'user_id', 'credit_card_id');
    }

    /**
     * Says if the user has the given role.
     * @param Role $role
     * @return bool
     */
    public function authorizeRole($role) {

        $has_role = $this->role->id == $role->id;

        return $has_role || abort(401, 'This action is unauthorized.');
    }
}

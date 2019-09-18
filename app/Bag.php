<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reference', 'user_subscription_id'];

    /**
     * Bag of a {@link UserSubscription}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userSubscription()
    {
        return $this->belongsTo(UserSubscription::class);
    }
}

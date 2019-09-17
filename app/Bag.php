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
    protected $fillable = ['reference', 'client_subscription_id'];

    /**
     * Bag of a {@link ClientSubscription}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientSubscription()
    {
        return $this->belongsTo(ClientSubscription::class);
    }
}

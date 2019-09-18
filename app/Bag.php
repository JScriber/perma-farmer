<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bag extends Model
{

    /**
     * Lists the bags that are not linked to any {@link User}.
     * @return \Illuminate\Database\Query\Builder
     */
    public static function listAvailable() {
        return DB::table('bags')->whereNull('user_subscription_id');
    }

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

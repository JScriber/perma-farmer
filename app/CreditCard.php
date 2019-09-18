<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'owner', 'type', 'card_number', 'crypto', 'expiration_date'];

    /**
     * {@link Client} who uses the {@link CreditCard}.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

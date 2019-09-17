<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crate extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reference'];

    /**
     * {@link Basket Baskets} the {@link Crate} has been used for.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }
}

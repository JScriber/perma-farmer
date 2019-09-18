<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * @package App
 */
class Subscription extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'max_weight', 'price'];

}

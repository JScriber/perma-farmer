<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * Client role.
     * @return mixed
     */
    public static function clientRole() {
        return Role::all()->where('name', 'Client simple')->first();
    }

    /**
     * Admin role.
     * @return mixed
     */
    public static function adminRole() {
        return Role::all()->where('name', 'Membre du staff')->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * {@link User Users} with the role.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
